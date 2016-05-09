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
}