<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use umeworld\lib\PhoneValidator;
use common\model\User;
use common\model\MobileVerify;
use common\model\DeliveryAddress;
use common\model\Mark;

trait UserApi{
		
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
			'gold' => static::REGISTER_USER_GIVE_GOLD,
			'create_time' => NOW_TIME,
		]);
		
		if(!$mUser){
			return new Response('注册失败', 1207);	
		}
		
		return new Response('注册成功', 1, $this->_getUserToken($mUser->id));
	}
	
	private function loginUser(){
		$mobile = Yii::$app->request->post('mobile');
		
		$mUser = [];
		if($mobile){
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
		}else{
			$type = Yii::$app->request->post('type');
			$uuid = Yii::$app->request->post('uuid');
			$name = Yii::$app->request->post('name');
			$avatar = Yii::$app->request->post('avatar');
			
			if(!$type){
				return new Response('缺少第三方登录类型', 1304);
			}
			if(!$uuid){
				return new Response('缺少第三方唯一标识', 1305);
			}
		
			$mUser = User::findOne([
				'type' => $type,
				'uuid' => $uuid
			]);
			if(!$mUser){
				$mUser = User::registerUser([
					'type' => $type,
					'uuid' => $uuid,
					'name' => $name,
					'avatar' => $avatar,
					'gold' => static::REGISTER_USER_GIVE_GOLD,
					'create_time' => NOW_TIME,
				]);
				if(!$mUser){
					return new Response('第三方注册失败', 1306);	
				}
			}
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
	
	private function bindUserMobile(){
		$userToken = Yii::$app->request->post('user_token');
		$mobile = Yii::$app->request->post('mobile');
		
		if(!$userToken){
			return new Response('缺少user_token', 3801);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3802);
		}
		
		if(!(new PhoneValidator())->validate($mobile)){
			return new Response('手机格式不正确', 3803);
		}
		
		$mTempUser = User::findOne(['mobile' => $mobile]);
		if($mTempUser){
			return new Response('手机已被绑定了', 3804);
		}
		$mUser->set('mobile', $mobile);
		$mUser->save();
		
		return new Response('绑定成功', 1);
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
		$area = Yii::$app->request->post('area');
		$street = Yii::$app->request->post('street');
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
			$mDeliveryAddress->set('area', $area);
			$mDeliveryAddress->set('street', $street);
			$mDeliveryAddress->set('is_default', $isDefault);
			$mDeliveryAddress->save();
		}else{
			DeliveryAddress::insert([
				'user_id' => $mUser->id,
				'name' => $name,
				'contact' => $contact,
				'area_id' => $areaId,
				'address' => $address,
				'area' => $area,
				'street' => $street,
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
			return new Response('异常操作', 2004);
		}
		$mDeliveryAddress->delete();
		
		return new Response('删除成功', 1);
	}
	
	private function getMarkInfo(){
		$userToken = Yii::$app->request->post('user_token');
		
		if(!$userToken){
			return new Response('缺少user_token', 2601);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		
		$mMark = Mark::findOne($userId);
		
		return new Response('签到信息', 1, $mMark->toArray());
	}
	
	private function mark(){
		$userToken = Yii::$app->request->post('user_token');
		
		if(!$userToken){
			return new Response('缺少user_token', 2601);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		
		$mMark = Mark::findOne($userId);
		if($mMark->last_mark_date == date('Ymd')){
			return new Response('今天已签到过了', 0);
		}
		if($mMark->last_mark_date == date('Ymd', strtotime("-1 day"))){
			$mMark->set('mark_continuous', ['add', 1]);
		}else{
			$mMark->set('mark_continuous', 1);
		}
		$mMark->set('mark_total', ['add', 1]);
		$mMark->set('last_mark_date', date('Ymd', NOW_TIME));
		$mMark->save();
		
		$mUser = User::findOne($userId);
		$gold = 0;
		if($mMark->mark_continuous <= 3){
			$gold = 1;
		}else{
			$a1 = [-5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5];
			$a2 = [-15, -14, -13, -12, -11, -10, -9, -8, -7, -6, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
			$a3 = [-20, 20];
			$rand = mt_rand(1, 100);
			if($rand <= 80){
				$gold = $a1[mt_rand(0, count($a1) - 1)];
			}elseif($rand > 80 && $rand <= 95){
				$gold = $a2[mt_rand(0, count($a2) - 1)];
			}elseif($rand > 95){
				$gold = $a3[mt_rand(0, count($a3) - 1)];
			}
		}
		if($gold < 0){
			if($mUser->gold + $gold < 0){
				$mUser->set('gold', 0);
			}else{
				$mUser->set('gold', ['sub', -$gold]);
			}
			$mUser->save();
		}elseif($gold > 0){
			$mUser->set('gold', ['add', $gold]);
			$mUser->save();
		}
		
		return new Response('签到成功', 1, $gold);
	}
	
}
