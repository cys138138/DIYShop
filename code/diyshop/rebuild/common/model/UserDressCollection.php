<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;
use yii\helpers\ArrayHelper;

class UserDressCollection extends \common\lib\DbOrmModel{

	public static function tableName(){
		return Yii::$app->db->parseTable('_@user_dress_collection');
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
		
		$aDressList = [];
		if($aList){
			$aDressIds = ArrayHelper::getColumn($aList, 'dress_id');
			$aDressList = Dress::getList($aDressIds);
		}
		foreach($aList as $key => $aValue){
			$aList[$key]['dress_info'] = [];
			foreach($aDressList as $k => $v){
				if($aValue['dress_id'] == $v['id']){
					$aList[$key]['dress_info'] = $v;
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
		if(isset($aCondition['user_id']) && $aCondition['user_id']){
			$aWhere[] = ['user_id' => $aCondition['user_id']];
		}
		if(isset($aCondition['sex']) && $aCondition['sex']){
			$aWhere[] = ['sex' => $aCondition['sex']];
		}
		if(isset($aCondition['dress_id']) && $aCondition['dress_id']){
			$aWhere[] = ['dress_id' => $aCondition['dress_id']];
		}

		return $aWhere;
	}
}