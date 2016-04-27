<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class DressCatalog extends \common\lib\DbOrmModel{

	public static function tableName(){
		return Yii::$app->db->parseTable('_@dress_catalog');
	}
	
	public static function initData($aData){
		(new Query())->createCommand()->insert(static::tableName(), $aData)->execute();
		return self::findOne(Yii::$app->db->getLastInsertID());
	}
}