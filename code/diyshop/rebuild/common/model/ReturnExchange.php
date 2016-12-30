<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;
use yii\helpers\ArrayHelper;

class ReturnExchange extends \common\lib\DbOrmModel{
	
	const TYPE_RETURN_AND_EXCHANGE = 1;	//退货退款
	const TYPE_RETURN_MONEY = 2;		//仅退款
	const TYPE_RETURN_GOODS = 3;		//仅换货
	
	protected $_aEncodeFields = ['pics'];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@return_exchange');
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
		if(!$aList){
			return [];
		}
		$aUserList = [];
		$aUserIds = ArrayHelper::getColumn($aList, 'user_id');
		if($aUserIds){
			$aUserList = User::findAll(['id' => $aUserIds], ['id', 'name', 'mobile']);
		}
		$aOrderList = [];
		$aOrderNumbers = ArrayHelper::getColumn($aList, 'order_number');
		if($aOrderNumbers){
			$aOrderList = Order::getList(['order_number' => $aOrderNumbers]);
		}
		foreach($aList as $k => $v){
			$aList[$k]['pics'] = json_decode($v['pics'], 1);
			$aList[$k]['order_info'] = [];
			foreach($aUserList as $aUser){
				if($aUser['id'] == $v['user_id']){
					$aList[$k]['user_info'] = $aUser;
					break;
				}
			}
			foreach($aOrderList as $aOrder){
				if($aOrder['order_number'] == $v['order_number']){
					$aList[$k]['order_info'] = $aOrder;
					break;
				}
			}
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
		if(isset($aCondition['type'])){
			$aWhere[] = ['type' => $aCondition['type']];
		}
		if(isset($aCondition['user_id'])){
			$aWhere[] = ['user_id' => $aCondition['user_id']];
		}
		if(isset($aCondition['vender_id'])){
			$aWhere[] = ['vender_id' => $aCondition['vender_id']];
		}
		if(isset($aCondition['order_number'])){
			$aWhere[] = ['order_number' => $aCondition['order_number']];
		}
		if(isset($aCondition['is_handle'])){
			$aWhere[] = ['is_handle' => $aCondition['is_handle']];
		}
		
		return $aWhere;
	}
	
	public static function getVenderRefundingRecordList($venderId){
		$aWhere = [
			'and',
			['vender_id' => $venderId],
			['refund_time' => 0],
			['>', 'refund_money', 0],
		];
		return (new Query())->from(self::tableName())->where($aWhere)->all();
	}
}