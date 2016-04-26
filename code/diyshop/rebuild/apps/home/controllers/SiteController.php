<?php
namespace home\controllers;

use Yii;
use home\lib\Controller;
use umeworld\lib\Response;
use umeworld\lib\Url;

/**
 * 站点控制器
 */
class SiteController extends Controller{

    public function actionIndex(){
		//debug(Yii::$app->user->getIdentity());
		//$mUser = \common\model\User::findOne(2);debug($mUser);
		//Yii::$app->user->login($mUser);
		//Yii::$app->user->logout();
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
