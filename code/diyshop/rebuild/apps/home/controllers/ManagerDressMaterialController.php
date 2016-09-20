<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\DressMaterial;
use yii\web\UploadedFile;

class ManagerDressMaterialController extends MController{
	
    public function actionShowList(){
		$aList = DressMaterial::findAll(['vender_id' => 0]);
		
		return $this->render('show-list', ['aList' => $aList]);
    }
	
	public function actionShowEdit(){
		$id = (int)Yii::$app->request->get('id');
		$aDressMaterial = [];
		$mDressMaterial = DressMaterial::findOne($id);
		if($mDressMaterial){
			$aDressMaterial = $mDressMaterial->toArray();
		}
		return $this->render('show-edit', [
			'aDressMaterial' => $aDressMaterial
		]);
    }
	
	public function actionSave(){
		$id = (int)Yii::$app->request->post('id');
		$name = (string)Yii::$app->request->post('name');
		
		if(!$name){
			return new Response('请输入面料名称', 0);
		}
		if($id){
			$mDressMaterial = DressMaterial::findOne($id);
			if($mDressMaterial){
				$mDressMaterial->set('name', $name);
				$mDressMaterial->save();
			}else{
				return new Response('找不到面料信息', 0);
			}
		}else{
			$isSuccess = DressMaterial::insert([
				'vender_id' => 0,
				'dress_id' => 0,
				'name' => $name,
			]);
			if(!$isSuccess){
				return new Response('保存失败', 0);
			}
		}
		return new Response('保存成功', 1);
    }
	
	public function actionDelete(){
		$id = (int)Yii::$app->request->post('id');
		
		$mDressMaterial = DressMaterial::findOne($id);
		if(!$mDressMaterial){
			return new Response('找不到面料信息', 0);
		}
		$mDressMaterial->delete();
		
		return new Response('删除成功', 1);
    }
	
}
