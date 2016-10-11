<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;
use yii\helpers\ArrayHelper;

class ManagerDressMatch extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = ['pics'];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@manager_dress_match');
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
		
		$aDressCatalogIds = ArrayHelper::getColumn($aList, 'catalog_id');
		$aDressCatalogList = DressCatalog::findAll(['id' => $aDressCatalogIds]);
		foreach($aList as $key => $aValue){
			$aList[$key]['pics'] = json_decode($aValue['pics'], 1);
			foreach($aDressCatalogList as $aDressCatalog){
				if($aDressCatalog['id'] == $aValue['catalog_id']){
					$aList[$key]['catalog_info'] = $aDressCatalog;
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

		return $aWhere;
	}
}