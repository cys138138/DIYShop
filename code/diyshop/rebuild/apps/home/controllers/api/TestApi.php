<?php
namespace home\controllers\api;

use Yii;

trait TestApi{
	
	public function actionTest(){
		$version = '1.0.0';
		$appCode = 'ios_diyshop';
		$timestamp = date('Y-m-d H:i:s');
		
		//getUserInfo
		$aParams = [
			'api_name' => 'getUserInfo',
			'user_id' => 111,
		];
		
		//sendVerifyCode
		$aParams = [
			'api_name' => 'sendVerifyCode',
			'mobile' => 15014191886,
		];
		
		//registerUser
		$aParams = [
			'api_name' => 'registerUser',
			'mobile' => 15014191886,
			'password' => 123456,
			'verify_code' => 481260,
		];
		
		//loginUser
		$aParams = [
			'api_name' => 'loginUser',
			'mobile' => 15014191886,
			'password' => 123456,
		];
		
		//verifyCode
		$aParams = [
			'api_name' => 'verifyCode',
			'mobile' => 15014191886,
			'verify_code' => 658339,
		];
		
		//setNewPassword
		$aParams = [
			'api_name' => 'setNewPassword',
			'mobile' => 15014191886,
			'password' => 123456,
		];
		
		//editUserInfo
		$aParams = [
			'api_name' => 'editUserInfo',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'user_name' => 'jay',
			'sex' => 1,
		];
		
		//getUserInfo
		$aParams = [
			'api_name' => 'getUserInfo',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
		];
		
		//saveUserDeliveryAddress
		$aParams = [
			'api_name' => 'saveUserDeliveryAddress',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'id' => 1,
			'name' => 'jay',
			'contact' => '020-8889898',
			'area_id' => '14000',
			'is_default' => 1,
			'address' => '广州',
		];
		
		//deleteUserDeliveryAddress
		$aParams = [
			'api_name' => 'deleteUserDeliveryAddress',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'id' => 2,
		];
		
		//createOrder
		$aParams = [
			'api_name' => 'createOrder',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'aOrderInfo' => [
				['dress_id' => 1, 'dress_size_color_count_id' => 22, 'count' => 2],
				['dress_id' => 2, 'dress_size_color_count_id' => 28, 'count' => 1],
				['dress_id' => 3, 'dress_size_color_count_id' => 30, 'count' => 1],
			],
		];
		
		$aData = [
			'version' => $version,
			'timestamp' => $timestamp,
			'app_code' => $appCode,
			'token' => md5($appCode . $timestamp . $aParams['api_name'] . $this->_appCode[$appCode]),
		];
		
		return $this->render('test', ['aReturn' => array_merge($aData, $aParams)]);
	}
	
}
