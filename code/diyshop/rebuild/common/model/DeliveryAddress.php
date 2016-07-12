<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;
use yii\helpers\ArrayHelper;

class DeliveryAddress extends \common\lib\DbOrmModel{

	public static function tableName(){
		return Yii::$app->db->parseTable('_@delivery_address');
	}

	public static function clearUserDefaultAddress($userId){
		$sql = 'update ' . self::tableName() . ' set `is_default`=0 where `user_id`=' . $userId;
		Yii::$app->db->createCommand($sql)->execute();
	}
}