<?php
namespace home\controllers;

use Yii;
use home\lib\VenderController as VController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\DressCatalog;
use common\model\DressComment;
use common\model\DressTag;
use common\model\DressSizeColorCount;
use common\model\Dress;
use common\model\form\DressListForm;

class DressManageController extends VController{
	
    public function actionShowList(){
		$oDressListForm = new DressListForm();
		$aParams = Yii::$app->request->get();
		if($aParams && (!$oDressListForm->load($aParams, '') || !$oDressListForm->validate())){
			return new Response(current($oDressListForm->getErrors())[0]);
		}
		$aList = $oDressListForm->getList();
		$oPage = $oDressListForm->getPageObject();
		
		return $this->render('show-list', [
			'dressId' => $oDressListForm->dressId,
			'aDressList' => $aList,
			'oPage' => $oPage,
		]);
    }
	
    public function actionShowEdit(){
		$id = (int)Yii::$app->request->get('id');
		
		$aDress = [];
		if($id){
			$mDress = Dress::findOne($id);
			if($mDress){
				$aDress = $mDress->toArray();
			}
		}
		
		return $this->render('show-edit', [
			'aDressCatalogList' => DressCatalog::findAll(),
			'aDress' => $aDress
		]);
    }
	
	public function actionSave(){
		$id = (int)Yii::$app->request->post('id');
		$name = (string)Yii::$app->request->post('name');
		$isShow = (int)Yii::$app->request->post('isShow');
		if(!$name){
			return new Response('请填写分类名称', -1);
		}
		$isSuccess = false;
		if($id){
			$mDress = Dress::findOne($id);
			if($mDress){
				$mDress->set('name', $name);
				$mDress->set('is_show', $isShow);
				$mDress->save();
				$isSuccess = true;
			}
		}else{
			$isSuccess = Dress::insert([
				'name' => $name,
				'is_show' => $isShow
			]);
		}
		
		if(!$isSuccess){
			return new Response('保存失败', 0);
		}
		return new Response('保存成功', 1);
	}
	
	public function actionDelete(){
		$id = (int)Yii::$app->request->post('id');
		
		$mDress = Dress::findOne($id);
		if(!$mDress){
			return new Response('找不到服饰信息', 0);
		}
		$isSuccess = $mDress->delete();
		if(!$isSuccess){
			return new Response('删除失败', 0);
		}
		return new Response('删除成功', 1);
	}
}
