<?php
namespace common\model\form;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * 后台通用图片上传表单
 */
class ImageUploadForm extends \yii\base\Model{
	public $aRules = [];

	/**
	 * @var yii\web\UploadFile 上传封面的实例
	 */
	public $oImage = null;

	/**
	 * @var bool 是否通过百度编辑器上传
	 */
	public $savePath = '';

	/**
	 * @var callable 自定义验证函数
	 */
	public $fCustomValidator = null;

	/**
	 * @var string 上传后的图片路径,基于@p.resource的相对路径
	 */
	public $savedFile = '';

	/**
	 * @var callable 命名函数
	 */
	public $fBuildFilename = null;
	
	public $tfn = '';

	/**
	 * @inheritedoc
	 */
	public function rules(){
		return ArrayHelper::merge([
			['oImage', 'required'],
			'image' => ['oImage', 'image'],
			'base' => ['oImage', 'file', 'maxSize' => 300000],
			'custom' => ['oImage', 'customValidate'],
		], $this->aRules);
	}

	/**
	 * 验证普通图片尺寸
	 * @param mixed $param
	 * @param string $attrName
	 * @return boolean
	 */
	public function customValidate($param, $attrName) {
		if(is_callable($this->fCustomValidator)){
			$function = $this->fCustomValidator;
			return $function($this);
		}else{
			return true;
		}
	}

	/**
	 * 上传图片
	 * @return boolean
	 */
	public function upload($savePath = null){
		if(!$this->validate()){
			return false;
		}

		$filePath = '';
		$resourcePath = Yii::getAlias('@p.resource');

		//获取保存的文件名
		$saveFileName = '';
		if(is_callable($this->fBuildFilename)){
			$fBuildFilename = $this->fBuildFilename;
			$saveFileName = $fBuildFilename($this->oImage);
		}else{
			$saveFileName = $this->_buildFileName($this->oImage);
		}

		if($savePath && is_dir(Yii::getAlias("@p.resource/$savePath"))){
			$filePath = $savePath . '/' . $saveFileName;
			if(strpos($filePath, $resourcePath) === 0){
				throw Yii::$app->buildError('自定义的的保存路径只要是@p.resource的相对路径即可,不需要包含@p.resource');
			}
		}else{
			$filePath = Yii::getAlias('@p.temp_upload') . '/' . $saveFileName;
		}

		$result = $this->oImage->saveAs($resourcePath . '/' . $filePath);
		if(!$result){
			$this->addError('oImage', '保存图片失败');
			return false;
		}else{
			$this->savedFile = $filePath;
			if(Yii::$app->qiniu->enable){
				$fileKey = Yii::$app->qiniu->uploadFile($resourcePath . '/' . $filePath);
				if($fileKey){
					$isSuccess = \common\model\QiNiuPicKeyMap::insert([
						'file_key' => $fileKey,
						'file_name' => $this->tfn,
						'file_path' => $filePath,
					]);
					if(!$isSuccess){
						$this->addError('oImage', '保存七牛图片失败');
						return false;
					}
				}else{
					$this->addError('oImage', '上传七牛失败');
					return false;
				}
			}
			return true;
		}
	}

	/**
	 * 构建上传后的文件名
	 * @param \yii\web\UploadFile $oImage
	 * @return string
	 */
	private function _buildFileName($oImage){
		$this->tfn = md5(microtime());
		return $this->tfn . '.' . $oImage->getExtension();
	}
}