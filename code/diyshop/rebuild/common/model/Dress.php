<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;
use yii\helpers\ArrayHelper;

class Dress extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = ['pics', 'dress_match_ids'];
	
	const DRESS_SEX_BOY = 1;	//男
	const DRESS_SEX_GIRL = 2;	//女
	
	
	const OFF_SALES_STATUS = 1;	//未上架
	const ON_SALES_STATUS = 2;	//已上架
	const DELETE_STATUS = 3;	//已删除

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
			ArrayHelper::multisort($aDressSizeColorCount, 'id', SORT_ASC);
			if($aDressSizeColorCount){
				$mDress->dress_size_color_count = $aDressSizeColorCount;
			}else{
				$mDress->dress_size_color_count = [];
			}
			$aDressTag = DressTag::findAll(['dress_id' => $mDress->id]);
			ArrayHelper::multisort($aDressTag, 'id', SORT_ASC);
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
		
		foreach($aList as $k => $v){
			$aList[$k]['pics'] = json_decode($v['pics'], 1);
			$aList[$k]['dress_match_ids'] = json_decode($v['dress_match_ids'], 1);
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
	
	public function saveSizeColorCount($aData){
		Yii::$app->db->createCommand()->delete(DressSizeColorCount::tableName(), ['dress_id' => $this->id])->execute();
		foreach($aData as $key => $aValue){
			(new Query())->createCommand()->insert(DressSizeColorCount::tableName(), [
				'vender_id' => $this->vender_id,
				'dress_id' => $this->id,
				'size_name' => $aValue['size'],
				'color_name' => $aValue['color'],
				'stock' => $aValue['count'],
				'pic' => $aValue['pic']
			])->execute();
		}
	}
	
	public function saveTag($aData){
		Yii::$app->db->createCommand()->delete(DressTag::tableName(), ['dress_id' => $this->id])->execute();
		foreach($aData as $key => $value){
			(new Query())->createCommand()->insert(DressTag::tableName(), [
				'vender_id' => $this->vender_id,
				'dress_id' => $this->id,
				'name' => $value
			])->execute();
		}
	}
	
	public static function getSizeColorList($id){
		return [
			'size_list' => (new Query())->select('size_name')->distinct('size_name')->from(DressSizeColorCount::tableName())->where(['vender_id' => $id])->all(),
			'color_list' => (new Query())->select('color_name')->distinct('color_name')->from(DressSizeColorCount::tableName())->where(['vender_id' => $id])->all(),
		];
	}
	
	public static function getTagList($id){
		return (new Query())->select('name')->distinct('name')->from(DressTag::tableName())->where(['vender_id' => $id])->all();
	}
	
}