<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class Dress extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = ['pics'];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@dress');
	}
	
	public static function findOne($xCondition){
		$mDress = parent::findOne($xCondition);
		if($mDress){
			$mDressCatalog = DressCatalog::findOne($mDress->catalog_id);
			if($mDressCatalog){
				$mDress->catalog_name = $mDressCatalog->name;
			}
			$aDressSizeColorCount = DressSizeColorCount::findAll(['dress_id' => $mDress->id]);
			if($aDressSizeColorCount){
				$mDress->dress_size_color_count = $aDressSizeColorCount;
			}else{
				$mDress->dress_size_color_count = [];
			}
			$aDressTag = DressTag::findAll(['dress_id' => $mDress->id]);
			if($aDressTag){
				$mDress->dress_tag = $aDressTag;
			}else{
				$mDress->dress_tag = [];
			}
		}
		
		return $mDress;
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