<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class Order extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = ['order_info', 'express_info'];

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
		if(isset($aCondition['vender_id'])){
			$aWhere[] = ['vender_id' => $aCondition['vender_id']];
		}
		if(isset($aCondition['order_number'])){
			$aWhere[] = ['order_number' => $aCondition['order_number']];
		}

		return $aWhere;
	}
	
	public static function getVenderSalesCountAndPrices($venderId, $startTime, $endTime){
		$sql = 'select sum(dress_count) as sales_count,sum(total_price) as total_price from `order` where vender_id=' . $venderId . ' and end_time>=' . $startTime . ' and end_time<=' . $endTime;
		$aResults = Yii::$app->db->createCommand($sql)->queryAll();
		return $aResults[0];
	}
}