<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;
use yii\helpers\ArrayHelper;

class Dress extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = ['pics', 'dress_match_ids'];
	
	const DRESS_SEX_BOY = 1;	//男
	const DRESS_SEX_GIRL = 2;	//女
	
	
	const VOTE_STATUS = 0;		//投票
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
			$aDressMaterial = DressMaterial::findAll(['dress_id' => $mDress->id]);
			ArrayHelper::multisort($aDressMaterial, 'id', SORT_ASC);
			if($aDressMaterial){
				$mDress->dress_material = $aDressMaterial;
			}else{
				$mDress->dress_material = [];
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
		
		if(!$aList){
			return [];
		}
		$aDressIds = ArrayHelper::getColumn($aList, 'id');
		$aDressSizeColorCount = DressSizeColorCount::findAll(['dress_id' => $aDressIds]);
		foreach($aList as $k => $v){
			$aList[$k]['pics'] = json_decode($v['pics'], 1);
			$aList[$k]['dress_match_ids'] = json_decode($v['dress_match_ids'], 1);
			$aList[$k]['dress_match_info'] = [];
			if(isset($aList[$k]['dress_match_ids']['vender']) && $aList[$k]['dress_match_ids']['vender']){
				$aList[$k]['dress_match_info'] = array_merge($aList[$k]['dress_match_info'], VenderDressMatch::getList(['id' => $aList[$k]['dress_match_ids']['vender']]));
			}
			if(isset($aList[$k]['dress_match_ids']['manager']) && $aList[$k]['dress_match_ids']['manager']){
				$aList[$k]['dress_match_info'] = array_merge($aList[$k]['dress_match_info'], ManagerDressMatch::getList(['id' => $aList[$k]['dress_match_ids']['manager']]));
			}
			$aList[$k]['dress_size_color_count_info'] = [];
			foreach($aDressSizeColorCount as $aValue){
				if($aValue['dress_id'] == $v['id']){
					array_push($aList[$k]['dress_size_color_count_info'], $aValue);
				}
			}
			$aList[$k]['dress_comment_count'] = DressComment::getCount(['dress_id' => $v['id']]);
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
		if(isset($aCondition['catalog_id']) && $aCondition['catalog_id']){
			$aWhere[] = ['catalog_id' => $aCondition['catalog_id']];
		}
		if(isset($aCondition['sex']) && $aCondition['sex']){
			$aWhere[] = ['sex' => $aCondition['sex']];
		}
		if(isset($aCondition['status'])){
			$aWhere[] = ['status' => $aCondition['status']];
		}
		if(isset($aCondition['name']) && $aCondition['name']){
			$aWhere[] = ['like', 'name', $aCondition['name']];
		}

		return $aWhere;
	}
	
	public function saveSizeColorCount($aData){
		$aIds = ArrayHelper::getColumn($aData, 'id');
		$aDressSizeColorCountList = DressSizeColorCount::findAll(['dress_id' => $this->id]);
		if($aDressSizeColorCountList){
			foreach($aDressSizeColorCountList as $aDressSizeColorCount){
				$mDressSizeColorCount = DressSizeColorCount::toModel($aDressSizeColorCount);
				if(!in_array($mDressSizeColorCount->id, $aIds)){
					$mDressSizeColorCount->delete();
				}
			}
		}
		foreach($aData as $key => $aValue){
			if(!isset($aValue['pic'])){
				$aValue['pic'] = [];
			}
			if(!isset($aValue['pics'])){
				$aValue['pics'] = [];
			}
			if(!$aValue['id']){
				(new Query())->createCommand()->insert(DressSizeColorCount::tableName(), [
					'vender_id' => $this->vender_id,
					'dress_id' => $this->id,
					'size_name' => $aValue['size'],
					'color_name' => $aValue['color'],
					'stock' => $aValue['count'],
					'pic' => json_encode($aValue['pic']),
					'pics' => json_encode($aValue['pics'])
				])->execute();
			}else{
				$mDressSizeColorCount = DressSizeColorCount::findOne($aValue['id']);
				if($mDressSizeColorCount){
					$mDressSizeColorCount->set('vender_id', $this->vender_id);
					$mDressSizeColorCount->set('dress_id', $this->id);
					$mDressSizeColorCount->set('size_name', $aValue['size']);
					$mDressSizeColorCount->set('color_name',$aValue['color']);
					$mDressSizeColorCount->set('stock',$aValue['count']);
					$mDressSizeColorCount->set('pic',$aValue['pic']);
					$mDressSizeColorCount->set('pics',$aValue['pics']);
					$mDressSizeColorCount->save();
				}
			}
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
	
	public function saveMaterial($aData){
		Yii::$app->db->createCommand()->delete(DressMaterial::tableName(), ['dress_id' => $this->id])->execute();
		foreach($aData as $key => $value){
			(new Query())->createCommand()->insert(DressMaterial::tableName(), [
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
	
	public static function getMaterilaList($id){
		return (new Query())->select('name')->distinct('name')->from(DressMaterial::tableName())->where(['vender_id' => [0, $id]])->all();
	}
	
}