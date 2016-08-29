<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use umeworld\lib\PhoneValidator;
use umeworld\lib\Xxtea;
use common\model\User;
use common\model\MobileVerify;
use common\model\DeliveryAddress;

trait UserApi{
	
	private function _getUserToken($id){
		return ['user_token' => Xxtea::encrypt($id . ':' . NOW_TIME)];
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
		if($mMobileVerify->verify_code != $verifyCode){
			return new Response('验证码不正确', 1205);	
		}
		
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
		
		return new Response('注册成功', 1, $this->_getUserToken($mUser->id));
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
		return new Response('登录成功', 1, $this->_getUserToken($mUser->id));
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
