<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class SystemSns extends \common\lib\DbOrmModel{

	const TYPE_DEFAULT = 0; 				//后台管理员通知
	const TYPE_LIKE_DRESS_ON_SALES = 1; 	//已添加喜爱的新服饰上架
	const TYPE_PAY_ORDER = 2; 				//付款通知
	const TYPE_SEND_GOODS = 3; 				//发货通知

	public static function tableName(){
		return Yii::$app->db->parseTable('_@system_sns');
	}
	
	public static function batchInsertRecord($aInsertList){
		return (new Query())->createCommand()->batchInsert(static::tableName(), ['user_id', 'type', 'content', 'data_id', 'create_time'], $aInsertList)->execute();
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
		
		foreach($aList as $key => $aValue){
			if($aValue['type'] == static::TYPE_LIKE_DRESS_ON_SALES){
				$aList[$key]['dress_id'] = $aValue['data_id'];
				$aList[$key]['picUrl'] = '';
				$mDressSizeColorCount = DressSizeColorCount::findOne(['dress_id' => $aValue['data_id']]);
				if($mDressSizeColorCount && isset($mDressSizeColorCount->pic[0]) && $mDressSizeColorCount->pic[0]){
					$aList[$key]['picUrl'] = $mDressSizeColorCount->pic[0];
				}
			}elseif($aValue['type'] == static::TYPE_PAY_ORDER || $aValue['type'] == static::TYPE_SEND_GOODS){
				$mOrder = Order::findOne($aValue['data_id']);
				if($mOrder){
					$aList[$key]['order_number'] = $mOrder->order_number;
					$aList[$key]['title'] = '';
					if($mOrder->order_type == Order::ORDER_TYPE_SPECIAL){
						$aOrderList = Order::getList(['order_number' => $mOrder->order_info]);
						$aList[$key]['title'] = $aOrderList[0]['order_info'][0]['item_info']['name'];
					}else{
						$aList[$key]['title'] = $mOrder->order_info[0]['item_info']['name'];
					}
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
		if(isset($aCondition['with_default_record']) && $aCondition['with_default_record']){
			$aWhereCondition = [
				'and',
				['type' => 0],
				['user_id' => 0],
			];
			$aReturnWhere = [
				'or',
				$aWhereCondition,
				$aWhere,
			];
			$aWhere = $aReturnWhere;
		}

		return $aWhere;
	}
}