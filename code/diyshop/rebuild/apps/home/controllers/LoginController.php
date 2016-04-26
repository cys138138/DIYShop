<?php
namespace home\controllers;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\Manager;

class LoginController extends \yii\web\Controller{
	public function actions(){
		return [
			'error' => [
				'class' => 'umeworld\lib\ErrorAction',
			],
		];
	}

	public function actionIndex(){
		return $this->render('manager');
    }
	
	public function actionManagerLogin(){
		$account = (string)Yii::$app->request->post('account');
		$password = (string)Yii::$app->request->post('password');
		
		if(!$account){
			return new Response('请填写账号', -1);
		}
		if(!$password){
			return new Response('请填写密码', -1);
		}
		
		$mManager = Manager::getManagerByAccountAndPassword($account, $password);
		if(!$mManager){
			return new Response('账号或密码不正确', -1);
		}
		
		if(!Yii::$app->manager->login($mManager)){
			return new Response('登录失败', 0);
		}
		
		return new Response('登录成功', 1, Url::to(['manager/index']));
	}
}
