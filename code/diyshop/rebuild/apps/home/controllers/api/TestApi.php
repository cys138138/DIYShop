<?php
namespace home\controllers\api;

use Yii;

trait TestApi{
	
	public function actionTest(){
		$version = '1.0.1';
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
			'area' => '海珠区',
			'street' => '人人街',
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
			'user_token' => 'zyLIVJ2fXqaRMOvB4ePW4g_e83ce__e83ce_',
			'delivery_address_id' => 14,
			'pay_money' => '0.01',
			'buyer_msg' => '不要发错货',
			'aOrderInfo' => [
				[
					'buyer_msg' => '',
					'count' => '1',
					'dress_id' => '13',
					'dress_size_color_count_id' => '132',
				]
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
			'aCommentInfo' => [
				[
					'dress_id' => 1,
					'desc_point' => 2,
					'delivery_point' => 3,
					'service_point' => 4,
					'comment' => '好看',
				],
				[
					'dress_id' => 2,
					'desc_point' => 2,
					'delivery_point' => 3,
					'service_point' => 4,
					'comment' => '好看',
				],
			]
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
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'page' => 1,
			'page_size' => 5,
			'keyword' => '',
		];
		
		//getDressCommentList
		$aParams = [
			'api_name' => 'getDressCommentList',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'page' => 1,
			'page_size' => 5,
			'dress_id' => 1,
		];
		
		//getDressDetail
		$aParams = [
			'api_name' => 'getDressDetail',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'dress_id' => 1,
		];
		
		//addToShoppingCart
		$aParams = [
			'api_name' => 'addToShoppingCart',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'dress_id' => 1,
			'count' => 2,
			'dress_size_color_count_id' => 112,
		];
		
		//getShoppingCartList
		$aParams = [
			'api_name' => 'getShoppingCartList',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'page' => 1,
			'page_size' => 5,
		];
		
		//deleteShoppingCart
		$aParams = [
			'api_name' => 'deleteShoppingCart',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'id' => 1,
		];
		
		//getGuessLikeList
		$aParams = [
			'api_name' => 'getGuessLikeList',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
		];
		
		//getVoteList
		$aParams = [
			'api_name' => 'getVoteList',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
		];
		
		//addUserDressCollection
		$aParams = [
			'api_name' => 'addUserDressCollection',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'dress_id' => 1,
		];
		
		//cancelUserDressCollection
		$aParams = [
			'api_name' => 'cancelUserDressCollection',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'dress_id' => 1,
		];
		
		//getUserDressCollectionList
		$aParams = [
			'api_name' => 'getUserDressCollectionList',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'page' => 1,
			'page_size' => 5,
		];
		
		//getHomePageAdvertisement
		$aParams = [
			'api_name' => 'getHomePageAdvertisement',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
		];
		
		//getDressDecorationList
		$aParams = [
			'api_name' => 'getDressDecorationList',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'page' => 1,
			'page_size' => 5,
		];
		
		//addReturnExchangeRecord
		$aParams = [
			'api_name' => 'addReturnExchangeRecord',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'vender_id' => 1,
			'order_number' => 'fb7f451b8af93a52936cd7c9dd6aa536',
			'type' => 1,
			'reason' => '不想要了',
			'desc' => '不想要了!!!',
			'pics' => ['/static/data/advertisement_position_img/6a94661a48f974e8bdf9c38d35b61400.jpeg', '/static/data/advertisement_position_img/6a94661a48f974e8bdf9c38d35b61400.jpeg'],
		];
		
		//getDressCatalogTree
		$aParams = [
			'api_name' => 'getDressCatalogTree',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
		];
		
		//voteDress
		$aParams = [
			'api_name' => 'voteDress',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'identity' => 'a0b13f2332683cadcbc85dc426a4e92d',
		];
			
		//cancelVoteDress
		$aParams = [
			'api_name' => 'cancelVoteDress',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'identity' => 'a0b13f2332683cadcbc85dc426a4e92d',
		];
			
		//orderPayCallback
		$aParams = [
			'api_name' => 'orderPayCallback',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'order_number' => '32bc4d435785c439bf01ab3a42f9fb6e',
		];
			
		//getQiniuToken
		$aParams = [
			'api_name' => 'getQiniuToken',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
		];
			
		//bindUserMobile
		$aParams = [
			'api_name' => 'bindUserMobile',
			'user_token' => 'ufR21YjhDm_ugsadu_AfXKQBtPHMg_e83ce__e83ce_',
			'mobile' => '15014142555',
		];
			
		//getPrePayParams
		$aParams = [
			'api_name' => 'getPrePayParams',
			'order_info' => 'app_id=2016102902405090&biz_content={"timeout_express":"30m","seller_id":"","product_code":"QUICK_MSECURITY_PAY","total_amount":"0.01","subject":"Unique Design","body":"Unique Design 服饰","out_trade_no":"1d1739962e17239ec1cb8664a5ff2426"}&charset=utf-8&method=alipay.trade.app.pay&notify_url=http://unique.xdh-syy.com/alipay/notify.html&sign_type=RSA&timestamp=2016-11-06 10:35:57&version=1.0',
		];
			
		//getUserOrderStatusCount
		$aParams = [
			'api_name' => 'getUserOrderStatusCount',
			'user_token' => 'zyLIVJ2fXqaRMOvB4ePW4g_e83ce__e83ce_',
		];
			
		//getSystemSnsList
		$aParams = [
			'api_name' => 'getSystemSnsList',
			'user_token' => 'zyLIVJ2fXqaRMOvB4ePW4g_e83ce__e83ce_',
		];
			
		//getReturnExchangeList
		$aParams = [
			'api_name' => 'getReturnExchangeList',
			'user_token' => 'zyLIVJ2fXqaRMOvB4ePW4g_e83ce__e83ce_',
		];
		
		//debug($this->_getUserToken(2),11);//zyLIVJ2fXqaRMOvB4ePW4g_e83ce__e83ce_
		
		$aData = [
			'version' => $version,
			'timestamp' => $timestamp,
			'app_code' => $appCode,
			'token' => md5($appCode . $timestamp . $aParams['api_name'] . $this->_appCode[$appCode]),
		];
		
		return $this->render('test', ['aReturn' => array_merge($aData, $aParams)]);
	}
	
}
