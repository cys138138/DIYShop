<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class ShoppingCart extends \common\lib\DbOrmModel{
	
	protected $_aEncodeFields = ['dress_info', 'size_color_info'];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@shopping_cart');
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
		
		foreach($aList as $k => $v){
			$aList[$k]['dress_info'] = json_decode($v['dress_info'], 1);
			$aList[$k]['size_color_info'] = json_decode($v['size_color_info'], 1);
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
		if(isset($aCondition['user_id']) && $aCondition['user_id']){
			$aWhere[] = ['user_id' => $aCondition['user_id']];
		}

		return $aWhere;
	}
}