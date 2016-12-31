<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class SystemSns extends \common\lib\DbOrmModel{

	const TYPE_DEFAULT = 0; 				//后台管理员通知
	const TYPE_LIKE_DRESS_ON_SALES = 1; 	//已添加喜爱的新服饰上架
	const TYPE_PAY_ORDER = 2; 				//付款通知
	const TYPE_SEND_GOODS = 3; 				//发货通知

	public static function tableName(){
		return Yii::$app->db->parseTable('_@system_sns');
	}
	
	public static function batchInsertRecord($aInsertList){
		return (new Query())->createCommand()->batchInsert(static::tableName(), ['user_id', 'type', 'content', 'data_id', 'create_time'], $aInsertList)->execute();
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
		
		foreach($aList as $key => $aValue){
			$aTemp = [
				'id' => $aValue['id'],
				'type' => $aValue['type'],
				'create_time' => $aValue['create_time']
			];
			if($aValue['type'] == static::TYPE_DEFAULT){
				$aTemp['title'] = $aValue['content'];
			}elseif($aValue['type'] == static::TYPE_LIKE_DRESS_ON_SALES){
				$aTemp['title'] = '亲，您之前关注的服饰现在已经上架了！点击此处即可前往查看！';
				$aTemp['dress_id'] = $aValue['data_id'];
				$aTemp['pic_url'] = '';
				$mDressSizeColorCount = DressSizeColorCount::findOne(['dress_id' => $aValue['data_id']]);
				if($mDressSizeColorCount && isset($mDressSizeColorCount->pic[0]) && $mDressSizeColorCount->pic[0]){
					$aTemp['pic_url'] = $mDressSizeColorCount->pic[0];
				}
			}elseif($aValue['type'] == static::TYPE_PAY_ORDER || $aValue['type'] == static::TYPE_SEND_GOODS){
				$aTemp['title'] = '';
				$aTemp['order_number'] = '';
				$aTemp['express_number'] = '';
				$mOrder = Order::findOne($aValue['data_id']);
				if($mOrder){
					$aTemp['order_number'] = $mOrder->order_number;
					if($mOrder->order_type == Order::ORDER_TYPE_SPECIAL){
						$aOrderList = Order::getList(['order_number' => $mOrder->order_info]);
						$aTemp['title'] = $aOrderList[0]['order_info'][0]['item_info']['name'];
						if(isset($aOrderList[0]['order_number'])){
							$aTemp['order_number'] = $aOrderList[0]['order_number'];
						}
						if(isset($aOrderList[0]['express_info']['express_number'])){
							$aTemp['express_number'] = $aOrderList[0]['express_info']['express_number'];
						}
					}else{
						$aTemp['title'] = $mOrder->order_info[0]['item_info']['name'];
						if(isset($mOrder->express_info['express_number'])){
							$aTemp['express_number'] = $mOrder->express_info['express_number'];
						}
					}
				}
				if($aTemp['title']){
					if($aValue['type'] == static::TYPE_PAY_ORDER){
						$aTemp['title'] = '亲，您的' . $aTemp['title'] . '订单已付款，请留意订单动态。';
					}elseif($aValue['type'] == static::TYPE_SEND_GOODS){
						$aTemp['title'] = '亲，您的' . $aTemp['title'] . '已经发货，请留意物流详情。';
					}
				}
			}
			$aList[$key] = $aTemp;
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
		if(isset($aCondition['type'])){
			$aWhere[] = ['type' => $aCondition['type']];
		}
		if(isset($aCondition['user_id'])){
			$aWhere[] = ['user_id' => $aCondition['user_id']];
		}
		if(isset($aCondition['with_default_record']) && $aCondition['with_default_record']){
			$aWhereCondition = [
				'and',
				['type' => 0],
				['user_id' => 0],
			];
			$aReturnWhere = [
				'or',
				$aWhereCondition,
				$aWhere,
			];
			$aWhere = $aReturnWhere;
		}

		return $aWhere;
	}
}