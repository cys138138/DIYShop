<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class DressCatalog extends \common\lib\DbOrmModel{
	const IS_SHOW = 1;
	const IS_NOT_SHOW = 0;

	public static function tableName(){
		return Yii::$app->db->parseTable('_@dress_catalog');
	}
	
	public static function initData($aData){
		(new Query())->createCommand()->insert(static::tableName(), $aData)->execute();
		return self::findOne(Yii::$app->db->getLastInsertID());
	}
	
	public static function getDressCatalogPath($id){
		$mDressChildCatalog = self::findOne($id);
		if($mDressChildCatalog){
			$mDressCatalog = self::findOne($mDressChildCatalog->pid);
			if($mDressCatalog){
				return $mDressCatalog->name . ' -> ' . $mDressChildCatalog->name;
			}
		}
		return '';
	}
	
	public static function getDressCatalogTree(){
		$aDressCatalogList = static::findAll(null, null, 0, 0, ['id' => SORT_DESC]);
		$aList = [];
		foreach($aDressCatalogList as $key => $aValue){
			if(!$aValue['pid']){
				array_push($aList, $aValue);
			}
		}
		
		foreach($aList as $k => $aData){
			if(!isset($aData['child'])){
				$aList[$k]['child'] = [];
			}
			foreach($aDressCatalogList as $key => $aValue){
				if($aData['id'] == $aValue['pid']){
					array_push($aList[$k]['child'], $aValue);
				}
			}
		}
		return $aList;
	}
}