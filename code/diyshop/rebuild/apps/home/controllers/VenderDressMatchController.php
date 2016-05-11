<?php
namespace home\controllers;

use Yii;
use home\lib\VenderController as VController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\DressCatalog;
use common\model\ManagerDressMatch;
use common\model\VenderDressMatch;
use common\model\form\VenderDressMatchListForm;
use common\model\form\ImageUploadForm;
use yii\web\UploadedFile;

class VenderDressMatchController extends VController{
	
    public function actionShowList(){
		$oVenderDressMatchListForm = new VenderDressMatchListForm();
		$aParams = Yii::$app->request->get();
		if($aParams && (!$oVenderDressMatchListForm->load($aParams, '') || !$oVenderDressMatchListForm->validate())){
			return new Response(current($oVenderDressMatchListForm->getErrors())[0]);
		}
		$aList = $oVenderDressMatchListForm->getList();
		$oPage = $oVenderDressMatchListForm->getPageObject();
		
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
			$mDressMatch = VenderDressMatch::findOne($id);
			if($mDressMatch){
				$aDressMatch = $mDressMatch->toArray();
				$mManagerDressMatch = ManagerDressMatch::findOne($mDressMatch->manager_dress_match_id);
				if($mManagerDressMatch){
					$aDressMatch['manager_dress_match'] = $mManagerDressMatch->toArray();
					$aDressMatch['catalog_id'] = $mManagerDressMatch->catalog_id;
					$aDressMatch['sex'] = $mManagerDressMatch->sex;
				}
				$mDressCatalog = DressCatalog::findOne($aDressMatch['catalog_id']);
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
	
	public function actionGetManagerDressMatchList(){
		$catalogId = (int)Yii::$app->request->post('catalogId');
		$sex = (int)Yii::$app->request->post('sex');
		
		$aList = ManagerDressMatch::findAll(['catalog_id' => $catalogId, 'sex' => $sex]);
		
		return new Response('', 1, $aList);
	}
	
	public function actionSave(){
		$id = (int)Yii::$app->request->post('id');
		$name = (string)Yii::$app->request->post('name');
		$managerDressMatchId = (int)Yii::$app->request->post('managerDressMatchId');
		$aPics = (array)Yii::$app->request->post('aPics');
		
		if(!$name){
			return new Response('请填写搭配别名', -1);
		}
		
		$mManagerDressMatch = ManagerDressMatch::findOne($managerDressMatchId);
		if(!$mManagerDressMatch){
			return new Response('找不到搭配信息', -1);
		}
		$aPics = array_values(array_diff($aPics, $mManagerDressMatch->pics));
		$isSuccess = false;
		if($id){
			$mVenderDressMatch = VenderDressMatch::findOne($id);
			if($mVenderDressMatch){
				$mVenderDressMatch->set('name', $name);
				$mVenderDressMatch->set('manager_dress_match_id', $managerDressMatchId);
				$mVenderDressMatch->set('pics', $aPics);
				$mVenderDressMatch->save();
				$isSuccess = true;
			}
		}else{
			$isSuccess = VenderDressMatch::insert([
				'name' => $name,
				'manager_dress_match_id' => $managerDressMatchId,
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
		
		$mVenderDressMatch = VenderDressMatch::findOne($id);
		if(!$mVenderDressMatch){
			return new Response('找不到搭配信息', 0);
		}
		$isSuccess = $mVenderDressMatch->delete();
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
