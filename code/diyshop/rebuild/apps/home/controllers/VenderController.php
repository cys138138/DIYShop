<?php
namespace home\controllers;

use Yii;
use home\lib\VenderController as VController;
use umeworld\lib\Response;
use umeworld\lib\Url;

class VenderController extends VController{

    public function actionIndex(){
        return $this->render('index');
    }
	
	public function actionLogout(){
		$mVender = Yii::$app->vender->getIdentity();
		if($mVender){
			Yii::$app->vender->logout($mVender);
		}
		return Yii::$app->response->redirect(Url::to(['site/index']));
	}

}
