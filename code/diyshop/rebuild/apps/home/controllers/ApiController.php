<?php
namespace home\controllers;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use umeworld\lib\PhoneValidator;
use umeworld\lib\Xxtea;
use common\model\User;
use common\model\MobileVerify;
use common\model\DeliveryAddress;

class ApiController extends \yii\web\Controller{
	private $_version = '1.0.0';
	private $_appCode = [
		'android_diyshop' => 'ce854c997d463edcfb54ac4e0732d139',	//app_code => app_key
		'ios_diyshop' => '538982ef3dcdad018e59d2884fd8add1'			//app_code => app_key
	];
	
	public $enableCsrfValidation = false;
	public function actions(){
		return [
			'error' => [
				'class' => 'umeworld\lib\ErrorAction',
			],
		];
	}
	
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
		
		$aData = [
			'version' => $version,
			'timestamp' => $timestamp,
			'app_code' => $appCode,
			'token' => md5($appCode . $timestamp . $aParams['api_name'] . $this->_appCode[$appCode]),
		];
		
		return $this->render('test', ['aReturn' => array_merge($aData, $aParams)]);
	}
	
	private function _getUserToken($id){
		return ['user_token' => Xxtea::encrypt($id . ':' . NOW_TIME)];
	}
		
	/*
		接口Http POST请求权限参数：
		1、version:版本号		string(10) 如：1.0
		2、api_name:接口名称	string(50) 如：getUserInfo
		3、timestamp:时间戳		string(20) 如：2016-05-28 11:04:32
		4、app_code:应用标识	string(20) 如：android_diyshop	ios_diyshop
		5、app_key:应用码(隐)	string(50) 如：Android:ce854c997d463edcfb54ac4e0732d139	IOS:538982ef3dcdad018e59d2884fd8add1
		6、token:数据有效签名	string(50) 如：md5(app_code + timestamp + api_name + app_key)
	*/
	public function actionIndex(){
		$_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $version = Yii::$app->request->post('version');
		$apiName = Yii::$app->request->post('api_name');
		$timeStamp = Yii::$app->request->post('timestamp');
		$appCode = Yii::$app->request->post('app_code');
		$token = Yii::$app->request->post('token');
		
		if(!$version){
			return new Response('缺少版本号', 1000);
		}
		if($version != $this->_version){
			return new Response('版本号错误', 1001);
		}
		if(!$appCode){
			return new Response('缺少应用标识', 1002);
		}
		if(!isset($this->_appCode[$appCode])){
			return new Response('应用标识错误', 1003);
		}
		if(!$timeStamp){
			return new Response('缺少时间戳', 1004);
		}
		if(!preg_match('/\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2}/', $timeStamp)){
			return new Response('时间戳格式错误', 1005);
		}
		if(!$token){
			return new Response('缺少token', 1006);
		}
		if($token != md5($appCode . $timeStamp . $apiName . $this->_appCode[$appCode])){
			return new Response('数据有效签名错误', 1007);
		}
		if(!$apiName){
			return new Response('缺少接口名称', 1008);
		}
		if(!method_exists($this, $apiName)){
			return new Response('接口名称错误', 1009);
		}
		
		return $this->$apiName();
	}
	
	private function _getUserIdByUserToken($userToken){
		$str = Xxtea::decrypt($userToken);
		$aData = explode(':', $str);
		if(isset($aData[0]) && $aData[0]){
			return $aData[0];
		}
		return 0;
	}
	
	private function sendVerifyCode(){
		$mobile = Yii::$app->request->post('mobile');
		
		if(!(new PhoneValidator())->validate($mobile)){
			return new Response('手机格式不正确', 1101);
		}
		
		$verifyCode = mt_rand(100000, 999999);
		$isNew = false;
		$mMobileVerify = MobileVerify::findOne(['mobile' => $mobile]);
		if(!$mMobileVerify){
			$isNew = true;
			$id = MobileVerify::insert([
				'mobile' => $mobile,
				'verify_code' => $verifyCode,
				'create_time' => NOW_TIME,
			]);
			$mMobileVerify = MobileVerify::findOne($id);
		}
		if(NOW_TIME - $mMobileVerify->create_time < 60){
			if(!$isNew){
				return new Response('请1分钟后再试', 1102);	
			}
		}else{
			$mMobileVerify->set('verify_code', $verifyCode);
			$mMobileVerify->set('create_time', NOW_TIME);
			$mMobileVerify->save();
		}
		$oSms = Yii::$app->sms;
		$oSms->sendTo = $mobile;
		$oSms->content = '您好，您的验证码是：' . $verifyCode;
		$returnCode = $oSms->send();
		if($returnCode <= 0){
			return new Response('发送失败', 1103);	
		}else{
			return new Response('发送成功', 1);	
		}
	}
	
	private function registerUser(){
		$mobile = Yii::$app->request->post('mobile');
		$password = Yii::$app->request->post('password');
		$verifyCode = Yii::$app->request->post('verify_code');
		
		if(!(new PhoneValidator())->validate($mobile)){
			return new Response('手机格式不正确', 1201);
		}
		if(!$password){
			return new Response('缺少密码', 1202);
		}
		$mMobileVerify = MobileVerify::findOne(['mobile' => $mobile]);
		if(!$mMobileVerify){
			return new Response('找不到验证码', 1203);	
		}
		if(NOW_TIME - $mMobileVerify->create_time > 300){
			return new Response('验证码超时', 1204);	
		}
		/*if($mMobileVerify->verify_code != $verifyCode){
			return new Response('验证码不正确', 1205);	
		}*/
		
		$mUser = User::getOneByAccountAndPassword($mobile, $password);
		if($mUser){
			return new Response('该手机已被注册了', 1206);	
		}
		
		$mUser = User::registerUser([
			'mobile' => $mobile,
			'password' => $password,
			'create_time' => NOW_TIME,
		]);
		
		if(!$mUser){
			return new Response('注册失败', 1207);	
		}
		
		return new Response('注册成功', 1, ['user_token' => $this->_getUserToken($mUser->id)]);
	}
	
	private function loginUser(){
		$mobile = Yii::$app->request->post('mobile');
		$password = Yii::$app->request->post('password');
		
		if(!(new PhoneValidator())->validate($mobile)){
			return new Response('手机格式不正确', 1301);
		}
		if(!$password){
			return new Response('缺少密码', 1302);
		}
		$mUser = User::getOneByAccountAndPassword($mobile, $password);
		if(!$mUser){
			return new Response('账号或密码错误', 1303);	
		}
		return new Response('登录成功', 1, ['user_token' => $this->_getUserToken($mUser->id)]);
	}
	
	private function verifyCode(){
		$mobile = Yii::$app->request->post('mobile');
		$verifyCode = Yii::$app->request->post('verify_code');
		
		if(!(new PhoneValidator())->validate($mobile)){
			return new Response('手机格式不正确', 1401);
		}
		$mMobileVerify = MobileVerify::findOne(['mobile' => $mobile]);
		if(!$mMobileVerify){
			return new Response('找不到验证码', 1402);	
		}
		if(NOW_TIME - $mMobileVerify->create_time > 300){
			return new Response('验证码超时', 1403);	
		}
		if($mMobileVerify->verify_code != $verifyCode){
			return new Response('验证码不正确', 1404);	
		}
		return new Response('验证成功', 1);
	}
	
	private function setNewPassword(){
		$mobile = Yii::$app->request->post('mobile');
		$password = Yii::$app->request->post('password');
		
		if(!(new PhoneValidator())->validate($mobile)){
			return new Response('手机格式不正确', 1501);
		}
		if(!$password){
			return new Response('缺少密码', 1502);
		}
		$mUser = User::findOne(['mobile' => $mobile]);
		if(!$mUser){
			return new Response('找不到用户信息', 1503);
		}
		$mUser->set('password', User::encryPassword($password));
		$mUser->save();
		
		return new Response('设置密码成功', 1);
	}
	
	private function editUserInfo(){
		$userToken = Yii::$app->request->post('user_token');
		$userName = Yii::$app->request->post('user_name');
		$sex = (int)Yii::$app->request->post('sex');
		$desc = Yii::$app->request->post('desc');
		$avatar = Yii::$app->request->post('avatar');
		
		if(!$userToken){
			return new Response('缺少user_token', 1601);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 1602);
		}
		$updateFlag = false;
		if($userName){
			$updateFlag = true;
			$mUser->set('user_name', $userName);
		}
		if($sex){
			$updateFlag = true;
			$mUser->set('sex', $sex);
		}
		if($desc){
			$updateFlag = true;
			$mUser->set('desc', $desc);
		}
		if($avatar){
			$updateFlag = true;
			$mUser->set('avatar', $avatar);
		}
		if($updateFlag){
			$mUser->save();
		}
		return new Response('保存成功', 1);
	}
	
	private function getUserInfo(){
		$userToken = Yii::$app->request->post('user_token');
		
		if(!$userToken){
			return new Response('缺少user_token', 1701);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 1702);
		}
		
		$aUser = $mUser->toArray();
		
		return new Response('用户信息', 1, $aUser);
	}
	
	private function getUserDeliveryAddressList(){
		$userToken = Yii::$app->request->post('user_token');
		
		if(!$userToken){
			return new Response('缺少user_token', 1801);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 1802);
		}
		
		$aList = DeliveryAddress::findAll(['user_id' => $mUser->id]);
		
		return new Response('收货地址列表', 1, $aList);
	}
	
	private function saveUserDeliveryAddress(){
		$userToken = Yii::$app->request->post('user_token');
		$id = Yii::$app->request->post('id');
		$name = Yii::$app->request->post('name');
		$contact = Yii::$app->request->post('contact');
		$areaId = (int)Yii::$app->request->post('area_id');
		$address = Yii::$app->request->post('address');
		$isDefault = (int)Yii::$app->request->post('is_default');
		
		if(!$userToken){
			return new Response('缺少user_token', 1901);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 1902);
		}
		
		if($isDefault){
			DeliveryAddress::clearUserDefaultAddress($userId);
		}
		
		if($id){
			$mDeliveryAddress = DeliveryAddress::findOne($id);
			if(!$mDeliveryAddress){
				return new Response('找不到收货地址信息', 1903);
			}
			if($mDeliveryAddress->user_id != $mUser->id){
				return new Response('异常操作', 1904);
			}
			$mDeliveryAddress->set('name', $name);
			$mDeliveryAddress->set('contact', $contact);
			$mDeliveryAddress->set('area_id', $areaId);
			$mDeliveryAddress->set('address', $address);
			$mDeliveryAddress->set('is_default', $isDefault);
			$mDeliveryAddress->save();
		}else{
			DeliveryAddress::insert([
				'user_id' => $mUser->id,
				'name' => $name,
				'contact' => $contact,
				'area_id' => $areaId,
				'address' => $address,
				'is_default' => $isDefault,
				'create_time' => NOW_TIME,
			]);
		}
		return new Response('保存成功', 1);
	}
	
	private function deleteUserDeliveryAddress(){
		$userToken = Yii::$app->request->post('user_token');
		$id = Yii::$app->request->post('id');
		
		if(!$userToken){
			return new Response('缺少user_token', 2001);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2002);
		}
		$mDeliveryAddress = DeliveryAddress::findOne($id);
		if(!$mDeliveryAddress){
			return new Response('找不到收货地址信息', 2003);
		}
		if($mDeliveryAddress->user_id != $mUser->id){
			return new Response('异常操作', 1904);
		}
		$mDeliveryAddress->delete();
		
		return new Response('删除成功', 1);
	}
	
}
