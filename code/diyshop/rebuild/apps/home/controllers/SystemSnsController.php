<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use common\model\SystemSns;
use common\model\User;
use umeworld\lib\PhoneValidator;

class SystemSnsController extends MController{

    public function actionIndex(){
		return $this->render('index');
    }
	
	public function actionSendSystemSns(){
		$mobile = (string)Yii::$app->request->post('mobile');
		$content = (string)Yii::$app->request->post('content');
		
		$userId = 0;
		if($mobile){
			if(!(new PhoneValidator())->validate($mobile)){
				return new Response('手机格式不正确', 0);
			}
			$mUser = User::findOne(['mobile' => $mobile]);
			if(!$mUser){
				return new Response('找不到用户信息', 0);
			}
			$userId = $mUser->id;
		}
		if(mb_strlen($content, 'utf-8') < 5 || mb_strlen($content, 'utf-8') > 500){
			return new Response('内容长度范围在5~500个字符', 0);
		}
		
		$isSuccess = SystemSns::insert([
			'user_id' => $userId,
			'type' => SystemSns::TYPE_DEFAULT,
			'content' => $content,
			'data_id' => 0,
			'create_time' => NOW_TIME,
		]);
		if(!$isSuccess){
			return new Response('发送失败', 0);
		}
		return new Response('发送成功', 1);
	}
}
