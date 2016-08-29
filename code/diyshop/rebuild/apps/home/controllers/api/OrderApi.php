<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\Dress;
use common\model\Order;
use common\model\DressSizeColorCount;

trait OrderApi{
	
	private function createOrder(){
		$aOrderInfo = Yii::$app->request->post('aOrderInfo');
		$userToken = Yii::$app->request->post('user_token');
		
		if(!$userToken){
			return new Response('缺少user_token', 2101);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		
		$aDressList = Dress::getList(['dress_id' => ArrayHelper::getColumn($aOrderInfo, 'dress_id')]);
		$aDressSizeColorCountList = DressSizeColorCount::findAll(['id' => ArrayHelper::getColumn($aOrderInfo, 'dress_size_color_count_id')]);
		
		if(!$aDressList){
			return new Response('找不到服饰信息', 2102);
		}
		foreach($aDressSizeColorCountList as $key => $value){
			foreach($aOrderInfo as $k => $v){
				if($value['id'] == $v['dress_size_color_count_id']){
					if($value['stock'] < $v['count']){
						return new Response('库存不足', 2103);
					}
				}
			}
		}
		foreach($aDressList as $key => $value){
			if($value['status'] != Dress::ON_SALES_STATUS){
				return new Response('服饰不在上架状态', 2104);
			}
		}
		$aOrderIdList = [];
		foreach($aOrderInfo as $k => $v){
			$mDressSizeColorCount = DressSizeColorCount::findOne($v['dress_size_color_count_id']);
			if(!$mDressSizeColorCount){
				return new Response('款式不存在', 2105);
			}
			$mDressSizeColorCount->set('stock', ['sub', intval($v['count'])]);
			$mDressSizeColorCount->save();
			$orderId = Order::insert([
				'order_type' => Order::ORDER_TYPE_NORMAL,
				'user_id' => $userId,
				'vender_id' => $mDressSizeColorCount->vender_id,
				'order_number' => Order::generateOrderNum(),
				'order_info' => [],
				'dress_count' => [],
				'total_price' => [],
				'status' => Order::ORDER_STATUS_CONFIRM,
				'express_info' => '',
				'create_time' => NOW_TIME,
				'pay_time' => 0,
				'deliver_time' => 0,
				'end_time' => 0,
			]);
		}
		
		//1、减库存	2、
		
		return new Response('', 1, $aDressList);
	}
	
}
