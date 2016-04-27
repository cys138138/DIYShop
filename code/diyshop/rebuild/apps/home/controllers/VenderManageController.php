<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\Vender;

class VenderManageController extends MController{
	
    public function actionShowList(){
		return $this->render('show-list', [
			'aVenderList' => []
		]);
    }
	
    public function actionShowEdit(){
		$id = (int)Yii::$app->request->get('id');
		
		$aVender = [];
		$mVender = Vender::findOne($id);
		if($mVender){
			$aVender = $mVender->toArray();
		}
		return $this->render('show-edit', [
			'aVender' => $aVender
		]);
    }
}
