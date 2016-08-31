<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class Mark extends \common\lib\DbOrmModel{

	public static function tableName(){
		return Yii::$app->db->parseTable('_@mark');
	}
	
	public static function findOne($xCondition){
		$mMark = parent::findOne($xCondition);
		if(!$mMark && is_numeric($xCondition)){
			self::insert([
				'id' => $xCondition,
				'mark_total' => 0,
				'mark_continuous' => 0,
				'last_mark_date' => 0,
			]);
			$mMark = parent::findOne($xCondition);
		}
		return $mMark;
	}
}