<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\DressCatalog;

class DressCatalogController extends MController{
	
    public function actionShowList(){
		$aList = DressCatalog::getDressCatalogTree();
		
		return $this->render('show-list', [
			'aDressCatalogList' => $aList
		]);
    }
	
    public function actionShowEdit(){
		$id = (int)Yii::$app->request->get('id');
		
		$aDressCatalog = [];
		$aDressCatalogList = DressCatalog::findAll(['pid' => 0]);
		if($id){
			$mDressCatalog = DressCatalog::findOne($id);
			if($mDressCatalog){
				$aDressCatalog = $mDressCatalog->toArray();
			}
		}
		
		return $this->render('show-edit', [
			'aDressCatalogList' => $aDressCatalogList,
			'aDressCatalog' => $aDressCatalog
		]);
    }
	
	public function actionSave(){
		$id = (int)Yii::$app->request->post('id');
		$pid = (int)Yii::$app->request->post('pid');
		$name = (string)Yii::$app->request->post('name');
		$isShow = (int)Yii::$app->request->post('isShow');
		if(!$name){
			return new Response('请填写分类名称', -1);
		}
		$isSuccess = false;
		if($id){
			$mDressCatalog = DressCatalog::findOne($id);
			if($mDressCatalog){
				$mDressCatalog->set('pid', $pid);
				$mDressCatalog->set('name', $name);
				$mDressCatalog->set('is_show', $isShow);
				$mDressCatalog->save();
				$isSuccess = true;
			}
		}else{
			$isSuccess = DressCatalog::initData([
				'pid' => $pid,
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
		
		$mDressCatalog = DressCatalog::findOne($id);
		if(!$mDressCatalog){
			return new Response('找不到分类信息', 0);
		}
		$isSuccess = $mDressCatalog->delete();
		if(!$isSuccess){
			return new Response('删除失败', 0);
		}
		return new Response('删除成功', 1);
	}
}
