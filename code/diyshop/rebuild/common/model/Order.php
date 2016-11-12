<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;
use yii\helpers\ArrayHelper;

class Order extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = ['order_info', 'express_info'];
	
	const ORDER_TYPE_NORMAL = 0;
	const ORDER_TYPE_SPECIAL = 1;
	
	//const ORDER_STATUS_CONFIRM = 1;			//确认订单
	const ORDER_STATUS_WAIT_PAY = 1; 		//待付款
	const ORDER_STATUS_WAIT_SEND = 2; 		//待发货
	const ORDER_STATUS_WAIT_RECEIVE = 3;	//待收货
	const ORDER_STATUS_APPLY_RETURN = 4; 	//申请退货
	const ORDER_STATUS_EXCHANGE = 5;		//退换货
	const ORDER_STATUS_FINISH = 6;			//确认收货
	const ORDER_STATUS_FAILURE = 7;			//失效
	const ORDER_STATUS_CLOSE = 8;			//交易关闭

	public static function tableName(){
		return Yii::$app->db->parseTable('_@order');
	}
	
	public static function getList($aCondition = [], $aControl = []){
		$aWhere = self::_parseWhereCondition($aCondition);
		$oQuery = new Query();
		$oQuery->from(static::tableName())->where($aWhere);
		if(isset($aControl['order_by'])){
			$oQuery->orderBy($aControl['order_by']);
		}
		if(isset($aControl['page']) && isset($aControl['page_size'])){
			$offset = ($aControl['page'] - 1) * $aControl['page_size'];
			$oQuery->offset($offset)->limit($aControl['page_size']);
		}
		$aList = $oQuery->all();
		
		foreach($aList as $k => $v){
			$aList[$k]['order_info'] = json_decode($v['order_info'], 1);
			$aList[$k]['express_info'] = json_decode($v['express_info'], 1);
		}
		
		return $aList;
	}
	
	public static function getCount($aCondition = []){
		$aWhere = self::_parseWhereCondition($aCondition);
		return (new Query())->from(self::tableName())->where($aWhere)->count();
	}
	
	private static function _parseWhereCondition($aCondition = []){
		$aWhere = ['and'];
		if(isset($aCondition['id'])){
			$aWhere[] = ['id' => $aCondition['id']];
		}
		if(isset($aCondition['order_type'])){
			$aWhere[] = ['order_type' => $aCondition['order_type']];
		}
		if(isset($aCondition['user_id'])){
			$aWhere[] = ['user_id' => $aCondition['user_id']];
		}
		if(isset($aCondition['vender_id'])){
			$aWhere[] = ['vender_id' => $aCondition['vender_id']];
		}
		if(isset($aCondition['status'])){
			$aWhere[] = ['status' => $aCondition['status']];
		}
		if(isset($aCondition['status_return_exchange']) && $aCondition['status_return_exchange']){
			$aWhere[] = [
				'or',
				['status' => static::ORDER_STATUS_APPLY_RETURN],
				['status' => static::ORDER_STATUS_EXCHANGE],
			];
		}
		if(isset($aCondition['order_number'])){
			$aWhere[] = ['order_number' => $aCondition['order_number']];
		}
		if(isset($aCondition['start_time']) && $aCondition['start_time']){
			$aWhere[] = ['>=', 'create_time', $aCondition['start_time']];
		}
		if(isset($aCondition['end_time']) && $aCondition['end_time']){
			$aWhere[] = ['<=', 'create_time', $aCondition['end_time']];
		}
		
		return $aWhere;
	}
	
	public static function getVenderSalesCountAndPrices($venderId, $startTime, $endTime){
		$sql = 'select sum(dress_count) as sales_count,sum(total_price) as total_price from `order` where vender_id=' . $venderId . ' and end_time>=' . $startTime . ' and end_time<=' . $endTime;
		$aResults = Yii::$app->db->createCommand($sql)->queryAll();
		return $aResults[0];
	}
	
	public static function generateOrderNum(){
		return date('YmdHis', NOW_TIME) . mt_rand(10, 99);
	}
	
	/**
	 *	处理失效订单，将3日前的订单失效，并调整库存
	 */
	public static function setOrderFailure(){
		set_time_limit(0);
		$venderId = (int)Yii::$app->request->get('vender_id');
		
		if($venderId){
			$aCondition = [
				'vender_id' => $venderId,
				'status' => static::ORDER_STATUS_WAIT_PAY,
				'end_time' => NOW_TIME - 3 * 86400,
			];
			$aControl = [
				'page' => 1,
				'page_size' => 1000,
				'order_by' => ['create_time' => SORT_DESC],
			];
			$aOrderList = static::getList($aCondition, $aControl);
			
			static::returnOrderDressStock($aOrderList);
		}
	}
	
	/**
	 *	返回订单库存
	 */
	public static function returnOrderDressStock($aOrderList = []){
		$aDressSizeColorCountInfo = [];
		foreach($aOrderList as $key => $aOrder){
			$mOrder = static::toModel($aOrder);
			if(!$mOrder->order_type){
				foreach($mOrder->order_info as $aOrderInfo){
					if(isset($aOrderInfo['item_size_color_count_info']) && isset($aOrderInfo['item_size_color_count_info']['id'])){
						if(!isset($aDressSizeColorCountInfo[$aOrderInfo['item_size_color_count_info']['id']])){
							$aDressSizeColorCountInfo[$aOrderInfo['item_size_color_count_info']['id']] = 0;
						}
						$aDressSizeColorCountInfo[$aOrderInfo['item_size_color_count_info']['id']] += $aOrderInfo['item_count'];
					}
				}
			}
		}
		$aOrderIds = ArrayHelper::getColumn($aOrderList, 'id');
		if(!$aOrderIds){
			return;
		}
		$sql = 'update `' . static::tableName() . '` set `status`=' . static::ORDER_STATUS_FAILURE . ' where `id` in(' . implode(',', $aOrderIds) . ')';
		Yii::$app->db->createCommand($sql)->execute();
		foreach($aDressSizeColorCountInfo as $dressSizeColorCountId => $count){
			$mDressSizeColorCount = DressSizeColorCount::findOne($dressSizeColorCountId);
			if($mDressSizeColorCount && $count){
				$mDressSizeColorCount->set('stock', ['add', $count]);
				$mDressSizeColorCount->save();
			}
		}
	}
	
	public static function updateDressSaleCount($aOrderInfo = []){
		foreach($aOrderInfo as $aOrder){
			if(isset($aOrder['item_info']) && isset($aOrder['item_count']) && isset($aOrder['item_info']['id'])){
				$mDress = Dress::toModel($aOrder['item_info']);
				$mDress->set('sale_count', ['add', $aOrder['item_count']]);
				$mDress->save();
			}
		}
	}
	
}