<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use yii\helpers\ArrayHelper;
use umeworld\lib\Url;
use common\model\Dress;
use common\model\VoteRecord;
use common\model\Vote;
use common\model\form\ImageUploadForm;
use yii\web\UploadedFile;

class VoteController extends MController{

    public function actionShowList(){
		$aList = Vote::findAll();
		foreach($aList as $key => $aValue){
			$aList[$key]['vote_count'] = VoteRecord::getVoteCountByIdentity($aValue['identity']);
		}
        return $this->render('list', ['aList' => $aList ? $aList : []]);
    }

	public function actionShowSetting(){
		$aList = Vote::findAll();
		$aSizeList = [];
		foreach($aList as $key => $aValue){
			$aSizeList = array_merge($aSizeList, $aValue['aSize']);
		}
		$aSizeList = array_unique($aSizeList);
		
		return $this->render('setting', ['aSizeList' => $aSizeList ? $aSizeList : []]);
	}
	
	public function actionSaveSetting(){
		$dressId = (int)Yii::$app->request->post('dressId');
		$name = (string)Yii::$app->request->post('name');
		$description = (string)Yii::$app->request->post('description');
		$onSalesNumber = (string)Yii::$app->request->post('onSalesNumber');
		$material = (string)Yii::$app->request->post('material');
		$aSize = array_unique((array)Yii::$app->request->post('aSize'));
		$onSalesDay = (string)Yii::$app->request->post('onSalesDay');
		$pic = (string)Yii::$app->request->post('pic');
		
		$mVote = Vote::findOne(['dress_id' => $dressId]);
		if(!$mVote){
			return new Response('不能重复添加投票', -1);
		}
		
		$mDress = Dress::findOne($dressId);
		if(!$mDress){
			return new Response('找不到投票服饰', -1);
		}
		if(!$name){
			return new Response('请填写投票名称', -1);
		}
		if(!$description){
			return new Response('请填写投票说明', -1);
		}
		if(!$onSalesNumber){
			return new Response('请上传上架货号', -1);
		}
		if(!$material){
			return new Response('请填写主要材质', -1);
		}
		if(!$aSize){
			return new Response('请填写尺码', -1);
		}
		if(!$onSalesDay){
			return new Response('请填写上架日期', -1);
		}
		if(!$pic){
			return new Response('请上传投票图片', -1);
		}
		
		$isSuccess = Vote::insert([
			'dress_id' => $dressId,
			'identity' => md5($dressId),
			'name' => $name,
			'description' => $description,
			'onSalesNumber' => $onSalesNumber,
			'material' => $material,
			'aSize' => $aSize,
			'onSalesDay' => $onSalesDay,
			'pic' => $pic,
			'create_time' => NOW_TIME,
		]);
		if(!$isSuccess){
			return new Response('保存失败', 0);
		}
		
		return new Response('保存成功', 1);
	}
	
	public function actionDelete(){
		$id = (int)Yii::$app->request->post('id');
		
		$mVote = Vote::findOne($id);
		if(!$mVote){
			return new Response('找不到投票信息', -1);
		}
		if(!$mVote->delete()){
			return new Response('删除失败', 0);
		}
		
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
