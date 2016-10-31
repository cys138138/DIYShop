<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\UserDressCollection;
use common\model\User;
use common\model\Dress;

trait UserDressCollectionApi{
	
	private function addUserDressCollection(){
		$userToken = Yii::$app->request->post('user_token');
		$dressId = Yii::$app->request->post('dress_id');
		
		if(!$userToken){
			return new Response('缺少user_token', 3001);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3001);
		}
		
		$mDress = Dress::findOne($dressId);
		if(!$mDress){
			return new Response('找不到服饰', 3002);
		}
		
		$mUserDressCollection = UserDressCollection::findOne([
			'user_id' => $userId,
			'dress_id' => $dressId
		]);
		if($mUserDressCollection){
			return new Response('添加收藏成功', 1);
		}
		
		$isSuccess = UserDressCollection::insert([
			'user_id' => $userId,
			'sex' => $mDress->sex,
			'dress_id' => $dressId,
			'create_time' => NOW_TIME
		]);
		if(!$isSuccess){
			return new Response('添加收藏失败', 3004);
		}
		return new Response('添加收藏成功', 1);
	}
	
	private function cancelUserDressCollection(){
		$userToken = Yii::$app->request->post('user_token');
		$dressId = Yii::$app->request->post('dress_id');
		
		if(!$userToken){
			return new Response('缺少user_token', 3201);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3201);
		}
		
		$mDress = Dress::findOne($dressId);
		if(!$mDress){
			return new Response('找不到服饰', 3202);
		}
		
		$mUserDressCollection = UserDressCollection::findOne([
			'user_id' => $userId,
			'dress_id' => $dressId
		]);
		if(!$mUserDressCollection){
			return new Response('找不到收藏', 3203);
		}
		if(!$mUserDressCollection->delete()){
			return new Response('取消收藏失败', 3204);
		}
		
		return new Response('取消收藏成功', 1);
	}
	
	private function getUserDressCollectionList(){
		$page = Yii::$app->request->post('page');
		$pageSize = Yii::$app->request->post('page_size');
		$userToken = Yii::$app->request->post('user_token');
		$sex = Yii::$app->request->post('sex');
		
		if($page < 1){
			$page = 1;
		}
		if($pageSize < 1){
			$pageSize = 5;
		}
		
		if(!$userToken){
			return new Response('缺少user_token', 3101);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3101);
		}
		$aCondition = ['user_id' => $userId];
		if($sex){
			$aCondition['sex'] = $sex;
		}
		$aControl = [
			'page' => $page,
			'page_size' => $pageSize,
			'order_by' => ['create_time' => SORT_DESC]
		];
		$aList = UserDressCollection::getList($aCondition, $aControl);
		
		
		return new Response('收藏列表', 1, $aList);
	}

}
