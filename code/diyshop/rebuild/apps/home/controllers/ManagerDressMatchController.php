<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\DressCatalog;
use common\model\ManagerDressMatch;
use common\model\form\ManagerDressMatchListForm;
use common\model\form\ImageUploadForm;
use yii\web\UploadedFile;

class ManagerDressMatchController extends MController{
	
    public function actionShowList(){
		$oManagerDressMatchListForm = new ManagerDressMatchListForm();
		$aParams = Yii::$app->request->get();
		if($aParams && (!$oManagerDressMatchListForm->load($aParams, '') || !$oManagerDressMatchListForm->validate())){
			return new Response(current($oManagerDressMatchListForm->getErrors())[0]);
		}
		$aList = $oManagerDressMatchListForm->getList();
		$oPage = $oManagerDressMatchListForm->getPageObject();
		
		foreach($aList as $key => $aValue){
			$aList[$key]['catalog_path'] = DressCatalog::getDressCatalogPath($aValue['catalog_id']);
			$aList[$key]['sex_str'] = $aValue['sex'] == \common\model\User::SEX_BOY ? '男' : '女';
		}
		
		return $this->render('show-list', [
			'aList' => $aList,
			'oPage' => $oPage,
		]);
    }
	
    public function actionShowEdit(){
		$id = (int)Yii::$app->request->get('id');
		
		$aDressMatch = [];
		if($id){
			$mDressMatch = ManagerDressMatch::findOne($id);
			if($mDressMatch){
				$aDressMatch = $mDressMatch->toArray();
				$mDressCatalog = DressCatalog::findOne($mDressMatch->catalog_id);
				if($mDressCatalog){
					$aDressMatch['dress_catalog'] = $mDressCatalog;
				}
			}
		}
		$aList = DressCatalog::findAll();
		$aDressCatalogList = [];
		$aDressCatalogChildList = [];
		foreach($aList as $key => $aValue){
			if($aValue['pid']){
				array_push($aDressCatalogChildList, $aValue);
			}else{
				array_push($aDressCatalogList, $aValue);
			}
		}
		
		return $this->render('show-edit', [
			'aDressCatalogList' => $aDressCatalogList,
			'aDressCatalogChildList' => $aDressCatalogChildList,
			'aDressMatch' => $aDressMatch
		]);
    }
	
	public function actionSave(){
		$id = (int)Yii::$app->request->post('id');
		$name = (string)Yii::$app->request->post('name');
		$sex = (int)Yii::$app->request->post('sex');
		$catalogId = (int)Yii::$app->request->post('catalogId');
		$aPics = (array)Yii::$app->request->post('aPics');
		
		if(!$name){
			return new Response('请填写搭配别名', -1);
		}
		$mDressCatalog = DressCatalog::findOne($catalogId);
		if(!$mDressCatalog){
			return new Response('找不到服饰分类信息', -1);
		}
		if(!in_array($sex, [\common\model\User::SEX_BOY, \common\model\User::SEX_GIRL])){
			return new Response('性别不正确', -1);
		}
		$isSuccess = false;
		if($id){
			$mManagerDressMatch = ManagerDressMatch::findOne($id);
			if($mManagerDressMatch){
				$mManagerDressMatch->set('name', $name);
				$mManagerDressMatch->set('sex', $sex);
				$mManagerDressMatch->set('catalog_id', $catalogId);
				$mManagerDressMatch->set('pics', $aPics);
				$mManagerDressMatch->save();
				$isSuccess = true;
			}
		}else{
			$isSuccess = ManagerDressMatch::insert([
				'name' => $name,
				'sex' => $sex,
				'catalog_id' => $catalogId,
				'pics' => $aPics,
				'create_time' => NOW_TIME
			]);
		}
		
		if(!$isSuccess){
			return new Response('保存失败', 0);
		}
		return new Response('保存成功', 1);
	}
	
	public function actionDelete(){
		$id = (int)Yii::$app->request->post('id');
		
		$mManagerDressMatch = ManagerDressMatch::findOne($id);
		if(!$mManagerDressMatch){
			return new Response('找不到搭配信息', 0);
		}
		$isSuccess = $mManagerDressMatch->delete();
		if(!$isSuccess){
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
		$savePath = Yii::getAlias('@p.dress') . '/' . mt_rand(10, 99);
		if(!is_dir(Yii::getAlias('@p.resource') . $savePath)){
			@mkdir(Yii::getAlias('@p.resource') . $savePath);
		}

		$oForm->oImage = UploadedFile::getInstanceByName('image');
		if(!$oForm->upload($savePath)){
			$message = current($oForm->getErrors())[0];
			return new Response($message, 0);
		}else{
			return new Response('', 1, $oForm->savedFile);
		}
	}
}
