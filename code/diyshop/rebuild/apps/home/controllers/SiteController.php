<?php
namespace home\controllers;

use Yii;
use home\lib\Controller;
use umeworld\lib\Response;
use umeworld\lib\Url;

/**
 * 站点控制器
 */
class SiteController extends \yii\web\Controller{
	public function actions(){
		return [
			'error' => [
				'class' => 'umeworld\lib\ErrorAction',
			],
		];
	}
	
    public function actionIndex(){
		$mManager = Yii::$app->manager->getIdentity();
		if($mManager){
			return Yii::$app->response->redirect(Url::to(['manager/index']));
		}
		$mVender = Yii::$app->vender->getIdentity();
		if($mVender){
			return Yii::$app->response->redirect(Url::to(['vender/index']));
		}
        return $this->render('index');
    }

    public function actionShowHome(){
		/*
		//select
		debug(\common\model\User::findOne(1)->toArray());
		$mUser = \common\model\User::findOne(1);
		//update
		$mUser->set('name', 'jay');
		$mUser->save();
		//insert
		debug(\common\model\User::insert(['name' => 'james']));
		//delete
		$mUser->delete();
		*/
        echo Url::to(['site/show-home']);
    }

}
