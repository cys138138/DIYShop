<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;
use yii\helpers\ArrayHelper;

class DressComment extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = ['pics'];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@dress_comment');
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
		
		$aUserList = [];
		if($aList){
			$aUserIds = ArrayHelper::getColumn($aList, 'user_id');
			$aUserList = User::getList($aUserIds);
		}
		foreach($aList as $key => $aValue){
			$aList[$key]['pics'] = json_decode($aValue['pics'], 1);
			foreach($aUserList as $k => $v){
				if($aValue['user_id'] == $v['id']){
					$mUser = User::toModel($v);
					$aList[$key]['user_info'] = $mUser->toArray(['id', 'user_name', 'sex', 'avatar']);
					break;
				}
			}
			$aOrderList = Order::getList([
				'order_type' => Order::ORDER_TYPE_NORMAL,
				'user_id' => $aValue['user_id'],
			], ['order_by' => ['create_time' => SORT_DESC]]);
			$aList[$key]['user_last_order_info'] = [];
			$flag = false;
			foreach($aOrderList as $m => $n){
				foreach($n['order_info'] as $aOrderInfo){
					if(isset($aOrderInfo['item_size_color_count_info']) && isset($aOrderInfo['item_size_color_count_info']['dress_id']) && $aOrderInfo['item_size_color_count_info']['dress_id'] == $aValue['dress_id']){
						$aList[$key]['user_last_order_info'] = $aOrderInfo['item_size_color_count_info'];
						$flag = true;
						break;
					}
				}
				if($flag){
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
		if(isset($aCondition['dress_id']) && $aCondition['dress_id']){
			$aWhere[] = ['dress_id' => $aCondition['dress_id']];
		}

		return $aWhere;
	}
}