<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\Setting;
use common\model\Dress;
use common\model\form\ImageUploadForm;
use yii\web\UploadedFile;

class DiscountActivityController extends MController{
	const DATA_SETTING_KEY = 'discount_activity_config';
	
	private function _getConfig(){
		return json_decode(Setting::getSetting(self::DATA_SETTING_KEY), true);
	}
	
	private function _setConfig($aData){
		return Setting::setSetting(self::DATA_SETTING_KEY, json_encode($aData));
	}

    public function actionShowList(){
		$aList = $this->_getConfig();
        return $this->render('list', ['aList' => $aList ? $aList : []]);
    }

	public function actionShowSetting(){
		return $this->render('setting');
	}
	
	public function actionSaveSetting(){
		$pic = (string)Yii::$app->request->post('pic');
		$linkUrl = (string)Yii::$app->request->post('linkUrl');
		
		if(!$linkUrl){
			return new Response('请填写活动链接', -1);
		}
		if(!$pic){
			return new Response('请上传活动图片', -1);
		}
		
		$aList = $this->_getConfig();
		if(!$aList){
			$aList = [];
		}
		array_push($aList, [
			'pic' => $pic,
			'link_url' => $linkUrl
		]);
		
		$this->_setConfig($aList);
		
		return new Response('保存成功', 1);
	}
	
	public function actionDelete(){
		$pic = (int)Yii::$app->request->post('pic');
		$aList = $this->_getConfig();
		$aData = [];
		if($aList){
			foreach($aList as $key => $aValue){
				if($aValue['pic'] != $pic){
					array_push($aData, $aValue);
				}
			}
		}
		$this->_setConfig($aData);
		
		return new Response('删除成功', 1);
	}
	
	public function actionUploadFile(){
		$oForm = new ImageUploadForm();
		$oForm->fCustomValidator = function($oForm){
			list($width, $height) = getimagesize($oForm->oImage->tempName);
			/*if($width != 340 || $height != 235){
				$oForm->addError('oImage', '图片宽高应为340px*235px');
				return false;
			}*/
			return true;
		};
		
		$isUploadFromUEditor = false;
		$savePath = Yii::getAlias('@p.advertisement_position_img');

		$oForm->oImage = UploadedFile::getInstanceByName('image');
		if(!$oForm->upload($savePath)){
			$message = current($oForm->getErrors())[0];
			return new Response($message, 0);
		}else{
			return new Response('', 1, $oForm->savedFile);
		}
	}
}
