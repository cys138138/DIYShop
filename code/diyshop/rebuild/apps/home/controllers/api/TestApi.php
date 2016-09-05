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
			'delivery_address_id' => 1,
			'buyer_msg' => '不要发错货',
			'aOrderInfo' => [
				['dress_id' => 1, 'dress_size_color_count_id' => 22, 'count' => 2],
				['dress_id' => 2, 'dress_size_color_count_id' => 28, 'count' => 1],
				['dress_id' => 3, 'dress_size_color_count_id' => 30, 'count' => 1],
			],
		];
		
		//getOrderInfo
		$aParams = [
			'api_name' => 'getOrderInfo',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'order_number' => '32bc4d435785c439bf01ab3a42f9fb6e',
		];
		
		//getOrderList
		$aParams = [
			'api_name' => 'getOrderList',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'page' => 1,
			'page_size' => 5,
			'status' => 1,
		];
		
		//finishOrder
		$aParams = [
			'api_name' => 'finishOrder',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'order_number' => 'c145329276f09fc7ade6abeb005c7d1a',
		];
		
		//deleteOrder
		$aParams = [
			'api_name' => 'deleteOrder',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'order_number' => '3d044b6aaa5cb1af22b6de54056e4a21',
		];
		
		//commentDress
		$aParams = [
			'api_name' => 'commentDress',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'dress_id' => 1,
			'desc_point' => 2,
			'delivery_point' => 3,
			'service_point' => 4,
			'comment' => '好看',
		];
		
		//getMarkInfo
		$aParams = [
			'api_name' => 'getMarkInfo',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
		];
		
		//mark
		$aParams = [
			'api_name' => 'mark',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
		];
		
		//getDressList
		$aParams = [
			'api_name' => 'getDressList',
			'page' => 1,
			'page_size' => 5,
			'keyword' => '',
		];
		
		//getDressCommentList
		$aParams = [
			'api_name' => 'getDressCommentList',
			'page' => 1,
			'page_size' => 5,
			'dress_id' => 1,
		];
		
		//getDressDetail
		$aParams = [
			'api_name' => 'getDressDetail',
			'dress_id' => 1,
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
