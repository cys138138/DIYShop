<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;

class ManagerController extends MController{

    public function actionIndex(){
        return $this->render('index');
    }
	
	public function actionLogout(){
		$mManager = Yii::$app->manager->getIdentity();
		if($mManager){
			Yii::$app->manager->logout($mManager);
		}
		return Yii::$app->response->redirect(Url::to(['site/index']));
	}

}
