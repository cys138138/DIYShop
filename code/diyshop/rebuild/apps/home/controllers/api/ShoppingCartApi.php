<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\ShoppingCart;
use common\model\User;
use common\model\Dress;
use common\model\DressSizeColorCount;

trait ShoppingCartApi{
	
	private function getShoppingCartList(){
		$page = Yii::$app->request->post('page');
		$pageSize = Yii::$app->request->post('page_size');
		$userToken = Yii::$app->request->post('user_token');
		
		if($page < 1){
			$page = 1;
		}
		if($pageSize < 1){
			$pageSize = 5;
		}
		
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2901);
		}
		
		$aCondition = ['user_id' => $userId];
		
		$aOrderBy = ['create_time' => SORT_DESC];
		
		$aControl = [
			'page' => $page,
			'page_size' => $pageSize,
			'order_by' => $aOrderBy,
		];
		$aList = ShoppingCart::getList($aCondition, $aControl);
		
		return new Response('购物车列表', 1, $aList);
	}
	
	private function addToShoppingCart(){
		$userToken = Yii::$app->request->post('user_token');
		$dressId = Yii::$app->request->post('dress_id');
		$count = Yii::$app->request->post('count');
		$dressSizeColorCountId = Yii::$app->request->post('dress_size_color_count_id');
		
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3001);
		}
		
		$mDress = Dress::findOne($dressId);
		if(!$mDress){
			return new Response('找不到服饰', 3002);
		}
		
		$mDressSizeColorCount = DressSizeColorCount::findOne($dressSizeColorCountId);
		if(!$mDressSizeColorCount){
			return new Response('找不到服饰相应尺码颜色', 3003);
		}
		
		if($count > $mDressSizeColorCount->stock){
			return new Response('服饰库存不足', 3004);
		}
		
		$mShoppingCart = ShoppingCart::findOne([
			'user_id' => $userId,
			'dress_id' => $dressId,
			'dress_size_color_count_id' => $dressSizeColorCountId,
		]);
		$isSuccess = false;
		if($mShoppingCart){
			$mShoppingCart->set('count', ['add', $count]);
			$isSuccess = $mShoppingCart->save();
		}else{
			$isSuccess = ShoppingCart::insert([
				'user_id' => $userId,
				'dress_id' => $dressId,
				'dress_size_color_count_id' => $dressSizeColorCountId,
				'count' => $count,
				'dress_info' => $mDress->toArray(),
				'size_color_info' => $mDressSizeColorCount->toArray(),
				'create_time' => NOW_TIME,
			]);
		}
		if(!$isSuccess){
			return new Response('添加失败', 3005);
		}
		
		return new Response('添加成功', 1);
	}
	
	private function deleteShoppingCart(){
		$userToken = Yii::$app->request->post('user_token');
		$aId = (array)Yii::$app->request->post('id',[]);
		
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3101);
		}
		
		if(!$aId){
			return new Response('找不到购物车商品信息', 3102);
		}
		
		foreach($aId as $id){			
			$mShoppingCart = ShoppingCart::findOne((int)$id);
			if(!$mShoppingCart){
				return new Response('找不到购物车商品信息', 3102);
			}
			
			if($mShoppingCart->user_id != $userId){
				return new Response('操作异常', 3103);
			}
			
			if(!$mShoppingCart->delete()){				
				return new Response('删除失败', 3104);
			}			
		}
		
		return new Response('删除成功', 1);
	}
	
}
