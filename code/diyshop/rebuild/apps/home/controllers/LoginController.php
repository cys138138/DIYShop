<?php
namespace home\controllers;

use umeworld\lib\Response;
use umeworld\lib\Url;
use Yii;
use yii\helpers\ArrayHelper;

class LoginController extends \yii\web\Controller{
	public function actions(){
		return [
			'error' => [
				'class' => 'umeworld\lib\ErrorAction',
			],
		];
	}

	public function actionIndex(){
		//echo '请登录！！！';
		//$mUser = \common\model\User::findOne(2);
		//Yii::$app->user->login($mUser);
		return $this->render('manager');
    }
}
