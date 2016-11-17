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
use common\model\ShoppingCart;

trait OrderApi{
	
	private function createOrder(){
		$userToken = Yii::$app->request->post('user_token');
		$aOrderInfo = Yii::$app->request->post('aOrderInfo');
		$deliveryAddressId = Yii::$app->request->post('delivery_address_id');
		$buyerMsg = Yii::$app->request->post('buyer_msg');
		$aShoppingCartId = (array)Yii::$app->request->post('aShoppingCartId');
		$payMoney = Yii::$app->request->post('pay_money');
		
		if(!$userToken){
			return new Response('缺少user_token', 2101);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2101);
		}
		
		$aDressList = Dress::getList(['id' => ArrayHelper::getColumn($aOrderInfo, 'dress_id')]);
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
			if(isset($v['aDecoration']) && $v['aDecoration']){
				foreach($v['aDecoration'] as $decorationInfo){
					if(!isset($decorationInfo['id']) || !isset($decorationInfo['count']) || !$decorationInfo['id'] || !$decorationInfo['count']){
						return new Response('饰件格式错误', 2109);
					}
					$mDressDecoration = DressDecoration::findOne($decorationInfo['id']);
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
			$itemPrice = $mDress->discount_price ? $mDress->discount_price * $v['count'] : $mDress->price * $v['count'];
			array_push($aOrderList[$mDress->vender_id]['order_info'], [
				'item_info' => $mDress->toArray(),
				'shop_info' => $mVenderShop->toArray(),
				'item_size_color_count_info' => $mDressSizeColorCount->toArray(),
				'item_count' => $v['count'],
				'item_price' => $itemPrice,
				'delivery_address_info' => $mDeliveryAddress->toArray(),
				'decoration_ids' => isset($v['aDecoration']) && $v['aDecoration'] ? $v['aDecoration'] : [],
				'diy_pics' => isset($v['aDiyPics']) && $v['aDiyPics'] ? $v['aDiyPics'] : [],
				'dress_match' => isset($v['aDressMatch']) && $v['aDressMatch'] ? $v['aDressMatch'] : [],
				'dress_decoration_info' => $aDecorationList,
				'dress_match_info' => $aDressMatchList,
				'buyer_msg' => isset($v['buyer_msg']) && $v['buyer_msg'] ? $v['buyer_msg'] : '',
			]);
			$aOrderList[$mDress->vender_id]['total_count'] += $v['count'];
			$aOrderList[$mDress->vender_id]['total_price'] += $itemPrice + $diyPrice;
		}
		$aOrderInfo = [];
		$totalCount = 0;
		$totalPrices = 0;
		$aTempOrderIds = [];
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
				'is_comment' => 0,
				'create_time' => NOW_TIME,
				'pay_type' => 0,
				'pay_money' => $payMoney,
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
			array_push($aTempOrderIds, $orderId);
		}
		if(sprintf("%.2f", $totalPrices) != $payMoney){
			if($aTempOrderIds){
				Yii::$app->db->createCommand()->delete(Order::tableName(), ['id' => $aTempOrderIds])->execute();
			}
			return new Response('计算订单总价出错', 2111);
		}
		if(!$aOrderInfo){
			return new Response('创建订单失败', 2112);
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
				'is_comment' => 0,
				'create_time' => NOW_TIME,
				'pay_type' => 0,
				'pay_money' => $payMoney,
				'pay_time' => 0,
				'deliver_time' => 0,
				'end_time' => 0,
			];
			$orderId = Order::insert($aData);
			if(!$orderId){
				return new Response('创建订单失败', 2113);
			}
		}
		if($aShoppingCartId){
			foreach($aShoppingCartId as $shoppingCartId){
				$mShoppingCart = ShoppingCart::findOne($shoppingCartId);
				if($mShoppingCart && $mShoppingCart->user_id == $userId){
					$mShoppingCart->delete();
				}
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
		$aCondition = [
			'user_id' => $userId,
			'order_type' => Order::ORDER_TYPE_NORMAL,
		];
		if($status){
			$aCondition['status'] = $status;
		}
		if(!is_array($status)){
			if(in_array($status, [Order::ORDER_STATUS_RETURN_GOODS, Order::ORDER_STATUS_RETURN_GOODS_SUCCESS, Order::ORDER_STATUS_RETURN_GOODS_CLOSE, Order::ORDER_STATUS_RETURN_MONEY, Order::ORDER_STATUS_RETURN_MONEY_SUCCESS, Order::ORDER_STATUS_RETURN_MONEY_CLOSE, Order::ORDER_STATUS_RETURN_GM, Order::ORDER_STATUS_RETURN_GM_SUCCESS, Order::ORDER_STATUS_RETURN_GM_CLOSE])){
				unset($aCondition['status']);
				$aCondition['status_return_exchange'] = 1;
			}
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
				if($mOrderTemp->status != Order::ORDER_STATUS_FINISH && $mOrderTemp->status != Order::ORDER_STATUS_FAILURE && $mOrderTemp->status != Order::ORDER_STATUS_CLOSE && $mOrderTemp->status != Order::ORDER_STATUS_RETURN_GOODS_SUCCESS && $mOrderTemp->status != Order::ORDER_STATUS_RETURN_GOODS_CLOSE && $mOrderTemp->status != Order::ORDER_STATUS_RETURN_MONEY_SUCCESS && $mOrderTemp->status != Order::ORDER_STATUS_RETURN_MONEY_CLOSE && $mOrderTemp->status != Order::ORDER_STATUS_RETURN_GM_SUCCESS && $mOrderTemp->status != Order::ORDER_STATUS_RETURN_GM_CLOSE){
					return new Response('订单不可删除', 2403);
				}
				$mOrderTemp->delete();
			}
		}else{
			if($mOrder->status != Order::ORDER_STATUS_FINISH && $mOrder->status != Order::ORDER_STATUS_FAILURE && $mOrder->status != Order::ORDER_STATUS_CLOSE && $mOrder->status != Order::ORDER_STATUS_RETURN_GOODS_SUCCESS && $mOrder->status != Order::ORDER_STATUS_RETURN_GOODS_CLOSE && $mOrder->status != Order::ORDER_STATUS_RETURN_MONEY_SUCCESS && $mOrder->status != Order::ORDER_STATUS_RETURN_MONEY_CLOSE && $mOrder->status != Order::ORDER_STATUS_RETURN_GM_SUCCESS && $mOrder->status != Order::ORDER_STATUS_RETURN_GM_CLOSE){
				return new Response('订单不可删除', 2403);
			}
		}
		$mOrder->delete();
		
		return new Response('删除订单成功', 1);
	}
	
	private function closeOrder(){
		$userToken = Yii::$app->request->post('user_token');
		$orderNumber = Yii::$app->request->post('order_number');
		
		if(!$userToken){
			return new Response('缺少user_token', 4101);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 4101);
		}
		
		if(!$orderNumber){
			return new Response('缺少order_number', 4102);
		}
		
		$mOrder = Order::findOne([
			'user_id' => $userId,
			'order_number' => $orderNumber,
		]);
		if(!$mOrder){
			return new Response('找不到订单信息', 4103);
		}
		if($mOrder->order_type == Order::ORDER_TYPE_SPECIAL){
			foreach($mOrder->order_info as $orderNum){
				$mOrderTemp = Order::findOne([
					'user_id' => $userId,
					'order_number' => $orderNum,
				]);
				if(!$mOrderTemp){
					return new Response('找不到订单信息', 4104);
				}
				if($mOrderTemp->status != Order::ORDER_STATUS_WAIT_PAY){
					return new Response('订单不可关闭交易', 4103);
				}
				$mOrderTemp->set('status', Order::ORDER_STATUS_CLOSE);
				$mOrderTemp->save();
			}
		}else{
			if($mOrder->status != Order::ORDER_STATUS_WAIT_PAY){
				return new Response('订单不可关闭交易', 4103);
			}
		}
		$mOrder->set('status', Order::ORDER_STATUS_CLOSE);
		$mOrder->save();
		
		$aOrderList = Order::getList(['order_number' => $orderNumber]);
		Order::returnOrderDressStock($aOrderList);
		
		return new Response('关闭交易成功', 1);
	}
	
	private function commentDress(){
		$userToken = Yii::$app->request->post('user_token');
		$aCommentInfo = Yii::$app->request->post('aCommentInfo');
		
		if(!$userToken){
			return new Response('缺少user_token', 2501);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2501);
		}
		
		if(!$aCommentInfo){
			return new Response('aCommentInfo参数不能为空', 2501);
		}
		
		foreach($aCommentInfo as $key => $aComment){
			if(!isset($aComment['dress_id']) || !$aComment['dress_id']){
				return new Response('缺少dress_id', 2502);
			}
			if(!isset($aComment['desc_point'])){
				return new Response('缺少desc_point', 2503);
			}
			if(!isset($aComment['delivery_point'])){
				return new Response('缺少delivery_point', 2504);
			}
			if(!isset($aComment['service_point'])){
				return new Response('缺少service_point', 2505);
			}
			if(!isset($aComment['comment'])){
				return new Response('缺少comment', 2506);
			}
			if(!isset($aComment['order_number'])){
				return new Response('缺少order_number', 2507);
			}
			$mOrder = Order::findOne(['order_number' => $aComment['order_number']]);
			if(!$mOrder){
				return new Response('订单不存在', 2507);
			}
			if(!isset($aComment['pics'])){
				$aComment['pics'] = [];
			}
			$isSuccess = DressComment::insert([
				'order_number' => $aComment['order_number'],
				'dress_id' => isset($aComment['dress_id']) ? $aComment['dress_id'] : 0,
				'user_id' => $userId,
				'desc_point' => $aComment['desc_point'],
				'delivery_point' => $aComment['delivery_point'],
				'service_point' => $aComment['service_point'],
				'comment' => $aComment['comment'],
				'pics' => $aComment['pics'],
				'is_anonymous' => $aComment['is_anonymous'] ? 1 : 0,
				'create_time' => NOW_TIME,
			]);
			if(!$isSuccess){
				return new Response('评论失败', 2508);
			}
			$mOrder->set('is_comment', 1);
			$mOrder->save();
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
		
		if(!$reason){
			return new Response('请填写退换货原因', 3304);
		}
		
		$mVender = Vender::findOne($venderId);
		if(!$mVender){
			return new Response('找不到商家信息', 3302);
		}
		$mOrder = Order::findOne(['order_number' => $orderNumber]);
		if(!$mOrder){
			return new Response('找不到订单信息', 3303);
		}
		
		$isSuccess = ReturnExchange::insert([
			'user_id' => $userId,
			'vender_id' => $venderId,
			'order_number' => $orderNumber,
			'type' => $type,
			'reason' => $reason,
			'desc' => $desc,
			'pics' => $aPics,
			'is_handle' => 0,
			'create_time' => NOW_TIME,
		]);
		if(!$isSuccess){
			return new Response('提交失败', 3305);
		}
		
		$status = 0;
		if($type == ReturnExchange::TYPE_RETURN_AND_EXCHANGE){
			$status = Order::ORDER_STATUS_RETURN_GM;
		}elseif($type == ReturnExchange::TYPE_RETURN_MONEY){
			$status = Order::ORDER_STATUS_RETURN_MONEY;
		}elseif($type == ReturnExchange::TYPE_RETURN_GOODS){
			$status = Order::ORDER_STATUS_RETURN_GOODS;
		}else{
			return new Response('类型不正确', 3306);
		}
		
		$mOrder->set('status', $status);
		$mOrder->save();
		
		return new Response('提交成功', 1);
	}
	
	private function orderPayCallback(){
		return new Response('接口不可用', 0);
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
	
	private function checkOrderExpressInfo(){
		$userToken = (string)Yii::$app->request->post('user_token');
		$orderNumber = (string)Yii::$app->request->post('order_number');
		
		if(!$userToken){
			return new Response('缺少user_token', 3901);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3901);
		}
		
		$mOrder = Order::findOne(['order_number' => $orderNumber]);
		if(!$mOrder){
			return new Response('找不到订单信息', 3903);
		}
		if($mOrder->user_id != $userId){
			return new Response('找不到用户订单信息', 3904);
		}
		if(!$mOrder->express_info || !isset($mOrder->express_info['express_type']) || !$mOrder->express_info['express_type'] || !isset($mOrder->express_info['express_number']) || !$mOrder->express_info['express_number']){
			return new Response('无物流信息', 3905);
		}
		
		$aResult = Yii::$app->kuaidi->query($mOrder->express_info['express_type'], $mOrder->express_info['express_number']);
		if(!isset($aResult['status']) || $aResult['status'] != 200){
			return new Response('查询物流信息失败', 3906, $aResult);
		}else{
			return new Response('物流信息', 1, $aResult['data']);
		}
	}
	
	/*private function checkOrderExpressInfo(){
		$userToken = (string)Yii::$app->request->post('user_token');
		$orderNumber = (string)Yii::$app->request->post('order_number');
		
		if(!$userToken){
			return new Response('缺少user_token', 3901);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3901);
		}
		
		$mOrder = Order::findOne(['order_number' => $orderNumber]);
		if(!$mOrder){
			return new Response('找不到订单信息', 3903);
		}
		if($mOrder->user_id != $userId){
			return new Response('找不到用户订单信息', 3904);
		}
		
		$aExpressInfo = [];
		if($mOrder->order_type == Order::ORDER_TYPE_SPECIAL){
			foreach($mOrder->order_info as $ordernum){
				$mTempOrder = Order::findOne(['order_number' => $ordernum]);
				if(!$mTempOrder){
					return new Response('找不到订单信息', 3906);
				}
				$aTemp = [
					'order_number' => $mTempOrder->order_number,
					'express_info' => $mTempOrder->express_info,
				];
				array_push($aExpressInfo, $aTemp);
			}
		}else{
			$aTemp = [
				'order_number' => $mOrder->order_number,
				'express_info' => $mOrder->express_info,
			];
			array_push($aExpressInfo, $aTemp);
		}
		
		$aData = [];
		foreach($aExpressInfo as $aExpress){
			if(!$aExpress || !isset($aExpress['express_info']) || !$aExpress['express_info'] || !isset($aExpress['express_info']['express_type']) || !$aExpress['express_info']['express_type'] || !isset($aExpress['express_info']['express_number']) || !$aExpress['express_info']['express_number']){
				array_push($aData, [
					'order_number' => $aExpress['order_number'],
					'express_info' => [
						'status' => 0,
						'message' => '无物流信息！',
					],
				]);
				continue;
			}
			$aResult = Yii::$app->kuaidi->query($aExpress['express_info']['express_type'], $aExpress['express_info']['express_number']);
			if(!isset($aResult['status']) || $aResult['status'] != 200){
				array_push($aData, [
					'order_number' => $aExpress['order_number'],
					'express_info' => $aResult,
				]);
			}else{
				array_push($aData, [
					'order_number' => $aExpress['order_number'],
					'express_info' => $aResult['data'],
				]);
			}
		}
		return new Response('物流信息', 1, $aData);
	}*/
}
