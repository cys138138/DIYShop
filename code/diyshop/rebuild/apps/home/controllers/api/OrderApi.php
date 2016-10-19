<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\Dress;
use common\model\Order;
use common\model\DressSizeColorCount;
use common\model\DeliveryAddress;
use common\model\VenderShop;
use common\model\DressComment;
use common\model\User;
use common\model\ReturnExchange;
use common\model\Vender;
use common\model\ManagerDressMatch;
use common\model\VenderDressMatch;
use common\model\DressDecoration;

trait OrderApi{
	
	private function createOrder(){
		$userToken = Yii::$app->request->post('user_token');
		$aOrderInfo = Yii::$app->request->post('aOrderInfo');
		$deliveryAddressId = Yii::$app->request->post('delivery_address_id');
		$buyerMsg = Yii::$app->request->post('buyer_msg');
		
		if(!$userToken){
			return new Response('缺少user_token', 2101);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2101);
		}
		
		$aDressList = Dress::getList(['dress_id' => ArrayHelper::getColumn($aOrderInfo, 'dress_id')]);
		$aDressSizeColorCountList = DressSizeColorCount::findAll(['id' => ArrayHelper::getColumn($aOrderInfo, 'dress_size_color_count_id')]);
		
		if(!$aDressList){
			return new Response('找不到服饰信息', 2102);
		}
		foreach($aDressList as $key => $value){
			if($value['status'] != Dress::ON_SALES_STATUS){
				return new Response('服饰不在上架状态', 2103);
			}
		}
		$mDeliveryAddress = DeliveryAddress::findOne($deliveryAddressId);
		if(!$mDeliveryAddress){
			return new Response('找不到收货地址信息', 2104);
		}
		if($mDeliveryAddress->user_id != $userId){
			return new Response('收货地址信息不正确', 2105);
		}
		foreach($aDressSizeColorCountList as $key => $value){
			foreach($aOrderInfo as $k => $v){
				if(!$v['count']){
					return new Response('数量有误', 2106);
				}
				if($value['id'] == $v['dress_size_color_count_id']){
					if($value['stock'] < $v['count']){
						return new Response('库存不足', 2107);
					}
				}
			}
		}
		$aOrderList = [];
		foreach($aOrderInfo as $k => $v){
			$mDressSizeColorCount = DressSizeColorCount::findOne($v['dress_size_color_count_id']);
			if(!$mDressSizeColorCount){
				return new Response('款式不存在', 2108);
			}
			$mDressSizeColorCount->set('stock', ['sub', intval($v['count'])]);
			$mDressSizeColorCount->save();
			
			$mDress = Dress::findOne($v['dress_id']);
			if(!$mDress){
				return new Response('服式不存在', 2109);
			}
			
			if(!isset($aOrderList[$mDress->vender_id])){
				$aOrderList[$mDress->vender_id] = [
					'order_info' => [],
					'total_count' => 0,
					'total_price' => 0,
				];
			}
			$diyPrice = 0;
			$aDecorationList = [];
			if(isset($v['aDecorationId']) && $v['aDecorationId']){
				foreach($v['aDecorationId'] as $decorationId){
					$mDressDecoration = DressDecoration::findOne($decorationId);
					if(!$mDressDecoration){
						return new Response('饰件不存在', 2109);
					}
					$diyPrice += $mDressDecoration->price;
					array_push($aDecorationList, $mDressDecoration->toArray());
				}
			}
			$aDressMatchList = [];
			if(isset($v['aDressMatch']) && $v['aDressMatch']){
				if(isset($v['aDressMatch']['manager']) && $v['aDressMatch']['manager']){
					$aManagerDressMatchList = ManagerDressMatch::findAll(['id' => $v['aDressMatch']['manager']]);
					foreach($aManagerDressMatchList as $q => $p){
						$diyPrice += $p['price'];
					}
					$aDressMatchList['manager'] = $aManagerDressMatchList;
				}
				if(isset($v['aDressMatch']['vender']) && $v['aDressMatch']['vender']){
					$aVenderDressMatchList = VenderDressMatch::findAll(['id' => $v['aDressMatch']['vender']]);
					foreach($aVenderDressMatchList as $q => $p){
						$diyPrice += $p['price'];
					}
					$aDressMatchList['vender'] = $aVenderDressMatchList;
				}
			}
			$mVenderShop = VenderShop::findOne($mDress->vender_id);
			array_push($aOrderList[$mDress->vender_id]['order_info'], [
				'item_info' => $mDress->toArray(),
				'shop_info' => $mVenderShop->toArray(),
				'item_size_color_count_info' => $mDressSizeColorCount->toArray(),
				'item_count' => $v['count'],
				'item_price' => $mDress->price * $v['count'],
				'delivery_address_info' => $mDeliveryAddress->toArray(),
				'decoration_ids' => isset($v['aDecorationId']) && $v['aDecorationId'] ? $v['aDecorationId'] : [],
				'diy_pics' => isset($v['aDiyPics']) && $v['aDiyPics'] ? $v['aDiyPics'] : [],
				'dress_match' => isset($v['aDressMatch']) && $v['aDressMatch'] ? $v['aDressMatch'] : [],
				'dress_decoration_info' => $aDecorationList,
				'dress_match_info' => $aDressMatchList,
				'buyer_msg' => isset($v['buyer_msg']) && $v['buyer_msg'] ? $v['buyer_msg'] : '',
			]);
			$aOrderList[$mDress->vender_id]['total_count'] += $v['count'];
			$aOrderList[$mDress->vender_id]['total_price'] += $mDress->price * $v['count'] + $diyPrice;
		}
		$aOrderInfo = [];
		$totalCount = 0;
		$totalPrices = 0;
		foreach($aOrderList as $k => $v){
			$totalCount += $v['total_count'];
			$totalPrices += $v['total_price'];
			$aData = [
				'order_type' => Order::ORDER_TYPE_NORMAL,
				'user_id' => $userId,
				'vender_id' => $k,
				'order_number' => Order::generateOrderNum(),
				'trace_num' => '',
				'order_info' => $v['order_info'],
				'dress_count' => $v['total_count'],
				'total_price' => $v['total_price'],
				'status' => Order::ORDER_STATUS_WAIT_PAY,
				'buyer_msg' => $buyerMsg,
				'express_info' => [],
				'create_time' => NOW_TIME,
				'pay_time' => 0,
				'deliver_time' => 0,
				'end_time' => 0,
			];
			$orderId = Order::insert($aData);
			if(!$orderId){
				return new Response('创建订单失败', 2110);
			}
			$aData['id'] = $orderId;
			array_push($aOrderInfo, $aData);
		}
		if(!$aOrderInfo){
			return new Response('创建订单失败', 2111);
		}
		$orderNumber = $aOrderInfo[0]['order_number'];
		if($aOrderInfo && count($aOrderInfo) > 1){
			$orderNumber = Order::generateOrderNum();
			$aData = [
				'order_type' => Order::ORDER_TYPE_SPECIAL,
				'user_id' => $userId,
				'vender_id' => 0,
				'order_number' => $orderNumber,
				'trace_num' => '',
				'order_info' => ArrayHelper::getColumn($aOrderInfo, 'order_number'),
				'dress_count' => $totalCount,
				'total_price' => $totalPrices,
				'status' => Order::ORDER_STATUS_WAIT_PAY,
				'buyer_msg' => $buyerMsg,
				'express_info' => [],
				'create_time' => NOW_TIME,
				'pay_time' => 0,
				'deliver_time' => 0,
				'end_time' => 0,
			];
			$orderId = Order::insert($aData);
			if(!$orderId){
				return new Response('创建订单失败', 2112);
			}
		}
		
		return new Response('创建订单成功', 1, $orderNumber);
	}
	
	private function getOrderInfo(){
		$userToken = Yii::$app->request->post('user_token');
		$orderNumber = Yii::$app->request->post('order_number');
		
		if(!$userToken){
			return new Response('缺少user_token', 2201);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2201);
		}
		if(!$orderNumber){
			return new Response('缺少order_number', 2202);
		}
		
		$mOrder = Order::findOne([
			'user_id' => $userId,
			'order_number' => $orderNumber,
		]);
		if(!$mOrder){
			return new Response('找不到订单信息', 2203);
		}
		$aOrderList = [$mOrder->toArray()];
		if($mOrder->order_type == Order::ORDER_TYPE_SPECIAL){
			$aOrderList = Order::getList(['order_number' => $mOrder->order_info]);
		}
		
		return new Response('订单信息', 1, $aOrderList);
	}
	
	private function getOrderList(){
		$userToken = Yii::$app->request->post('user_token');
		$status = Yii::$app->request->post('status');
		$page = Yii::$app->request->post('page');
		$pageSize = Yii::$app->request->post('page_size');
		
		if($page < 1){
			$page = 1;
		}
		if($pageSize < 1){
			$pageSize = 5;
		}
		
		if(!$userToken){
			return new Response('缺少user_token', 2201);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2201);
		}
		$aCondition = ['order_type' => Order::ORDER_TYPE_NORMAL];
		if($status){
			$aCondition['status'] = $status;
		}
		$aControl = [
			'page' => $page,
			'page_size' => $pageSize,
			'order_by' => ['create_time' => SORT_DESC],
		];
		$aOrderList = Order::getList($aCondition, $aControl);
		
		return new Response('订单列表', 1, $aOrderList);
	}
	
	private function finishOrder(){
		$userToken = Yii::$app->request->post('user_token');
		$orderNumber = Yii::$app->request->post('order_number');
		
		if(!$userToken){
			return new Response('缺少user_token', 2301);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2301);
		}
		
		if(!$orderNumber){
			return new Response('缺少order_number', 2302);
		}
		
		$mOrder = Order::findOne([
			'user_id' => $userId,
			'order_number' => $orderNumber,
		]);
		if(!$mOrder){
			return new Response('找不到订单信息', 2303);
		}
		if($mOrder->status != Order::ORDER_STATUS_WAIT_RECEIVE){
			return new Response('订单状态不正确', 2304);
		}
		$mOrder->set('status', Order::ORDER_STATUS_FINISH);
		$mOrder->set('end_time', NOW_TIME);
		$mOrder->save();
		if($mOrder->order_type == Order::ORDER_TYPE_SPECIAL){
			foreach($mOrder->order_info as $orderNum){
				$mOrderTemp = Order::findOne([
					'user_id' => $userId,
					'order_number' => $orderNum,
				]);
				if(!$mOrderTemp){
					return new Response('找不到订单信息', 2305);
				}
				if($mOrderTemp->status != Order::ORDER_STATUS_WAIT_RECEIVE){
					return new Response('订单状态不正确', 2306);
				}
				$mOrderTemp->set('status', Order::ORDER_STATUS_FINISH);
				$mOrderTemp->set('end_time', NOW_TIME);
				$mOrderTemp->save();
			}
		}
		return new Response('操作成功', 1);
	}
	
	private function deleteOrder(){
		$userToken = Yii::$app->request->post('user_token');
		$orderNumber = Yii::$app->request->post('order_number');
		
		if(!$userToken){
			return new Response('缺少user_token', 2401);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2401);
		}
		
		if(!$orderNumber){
			return new Response('缺少order_number', 2402);
		}
		
		$mOrder = Order::findOne([
			'user_id' => $userId,
			'order_number' => $orderNumber,
		]);
		if(!$mOrder){
			return new Response('找不到订单信息', 2403);
		}
		if($mOrder->order_type == Order::ORDER_TYPE_SPECIAL){
			foreach($mOrder->order_info as $orderNum){
				$mOrderTemp = Order::findOne([
					'user_id' => $userId,
					'order_number' => $orderNum,
				]);
				if(!$mOrderTemp){
					return new Response('找不到订单信息', 2404);
				}
				$mOrderTemp->delete();
			}
		}
		$mOrder->delete();
		
		return new Response('删除订单成功', 1);
	}
	
	private function commentDress(){
		$userToken = Yii::$app->request->post('user_token');
		$dressId = Yii::$app->request->post('dress_id');
		$descPoint = Yii::$app->request->post('desc_point');
		$deliveryPoint = Yii::$app->request->post('delivery_point');
		$servicePoint = Yii::$app->request->post('service_point');
		$comment = Yii::$app->request->post('comment');
		
		if(!$userToken){
			return new Response('缺少user_token', 2501);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2501);
		}
		
		$mDress = Dress::findOne($dressId);
		if(!$mDress){
			return new Response('找不到服饰', 2502);
		}
		$isSuccess = DressComment::insert([
			'dress_id' => $mDress->id,
			'user_id' => $userId,
			'desc_point' => $descPoint,
			'delivery_point' => $deliveryPoint,
			'service_point' => $servicePoint,
			'comment' => $comment,
			'create_time' => NOW_TIME,
		]);
		if(!$isSuccess){
			return new Response('评论失败', 2503);
		}
		return new Response('评论成功', 1);
	}
	
	
	private function addReturnExchangeRecord(){
		$userToken = (string)Yii::$app->request->post('user_token');
		$venderId = (int)Yii::$app->request->post('vender_id');
		$orderNumber = (string)Yii::$app->request->post('order_number');
		$type = (int)Yii::$app->request->post('type');
		$reason = (string)Yii::$app->request->post('reason');
		$desc = (string)Yii::$app->request->post('desc');
		$aPics = (array)Yii::$app->request->post('pics');
		
		if(!$userToken){
			return new Response('缺少user_token', 3301);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3301);
		}
		
		$mVender = Vender::findOne($venderId);
		if(!$mVender){
			return new Response('找不到商家信息', 3302);
		}
		$mOrder = Order::findOne(['order_number' => $orderNumber]);
		if(!$mOrder){
			return new Response('找不到订单信息', 3303);
		}
		if(!$reason){
			return new Response('请填写退换货原因', 3304);
		}
		
		$isSuccess = ReturnExchange::insert([
			'user_id' => $userId,
			'vender_id' => $venderId,
			'order_number' => $orderNumber,
			'type' => $type,
			'reason' => $reason,
			'desc' => $desc,
			'pics' => $aPics,
			'create_time' => NOW_TIME,
		]);
		if(!$isSuccess){
			return new Response('提交失败', 3305);
		}
		
		return new Response('提交成功', 1);
	}
	
	private function orderPayCallback(){
		$userToken = (string)Yii::$app->request->post('user_token');
		$orderNumber = (string)Yii::$app->request->post('order_number');
		
		if(!$userToken){
			return new Response('缺少user_token', 3701);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3701);
		}
		
		$mOrder = Order::findOne(['order_number' => $orderNumber]);
		if(!$mOrder){
			return new Response('找不到订单信息', 3703);
		}
		if($mOrder->status != Order::ORDER_STATUS_WAIT_PAY){
			return new Response('订单状态不正确', 3704);
		}
		
		$mOrder->set('status', Order::ORDER_STATUS_WAIT_SEND);
		$mOrder->set('pay_time', NOW_TIME);
		$mOrder->save();
		if($mOrder->order_type == Order::ORDER_TYPE_SPECIAL){
			foreach($mOrder->order_info as $ordernum){
				$mOrder = Order::findOne(['order_number' => $ordernum]);
				if(!$mOrder){
					return new Response('找不到订单信息', 3705);
				}
				$mOrder->set('status', Order::ORDER_STATUS_WAIT_SEND);
				$mOrder->set('pay_time', NOW_TIME);
				$mOrder->save();
			}
		}
		
		return new Response('操作成功', 1);
	}
}
