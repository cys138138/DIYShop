<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;
use yii\helpers\ArrayHelper;

class VenderDressMatch extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = ['pics', 'detail_pics'];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@vender_dress_match');
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
		
		$aManagerDressMatchIds = ArrayHelper::getColumn($aList, 'manager_dress_match_id');
		$aManagerDressMatchList = ManagerDressMatch::getList(['id' => $aManagerDressMatchIds]);
		$aCatalogIds = ArrayHelper::getColumn($aList, 'catalog_id');
		$aCatalogList = DressCatalog::findAll(['id' => $aCatalogIds]);
		/*$aDressCatalogIds = ArrayHelper::getColumn($aManagerDressMatchList, 'catalog_id');
		$aDressCatalogList = DressCatalog::findAll(['id' => $aDressCatalogIds]);
		foreach($aManagerDressMatchList as $k => $v){
			foreach($aDressCatalogList as $n => $m){
				if($m['id'] == $v['catalog_id']){
					$aManagerDressMatchList[$k]['catalog_info'] = $m;
				}
			}
		}*/
		foreach($aList as $key => $aValue){
			$aList[$key]['detail_pics'] = json_decode($aValue['detail_pics'], 1);
			$aList[$key]['pics'] = json_decode($aValue['pics'], 1);
			$aList[$key]['catalog_info'] = [];
			foreach($aManagerDressMatchList as $k => $v){
				if($v['id'] == $aValue['manager_dress_match_id']){
					$aList[$key]['catalog_id'] = $v['catalog_id'];
					$aList[$key]['catalog_info'] = $v['catalog_info'];
					$aList[$key]['sex'] = $v['sex'];
				}
			}
			if(!$aValue['manager_dress_match_id']){
				foreach($aCatalogList as $aCatalog){
					if($aCatalog['id'] == $aValue['catalog_id']){
						$aList[$key]['catalog_info'] = $aCatalog;
						break;
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
		if(isset($aCondition['vender_id']) && $aCondition['vender_id']){
			$aWhere[] = ['vender_id' => $aCondition['vender_id']];
		}

		return $aWhere;
	}
}