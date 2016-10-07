<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class Setting extends \common\lib\DbOrmModel{
	const GUESS_LIKE = 'guess_like_config';

	public static function tableName(){
		return Yii::$app->db->parseTable('_@setting');
	}
	
	public static function initData($aData){
		(new Query())->createCommand()->insert(static::tableName(), $aData)->execute();
		return self::findOne(Yii::$app->db->getLastInsertID());
	}

	public static function getSetting($key){
		$mSetting = self::findOne(['keystr' => $key]);
		if(!$mSetting){
			return '';
		}
		return $mSetting->valuestr;
	}
	
	public static function setSetting($key, $value){
		$mSetting = self::findOne(['keystr' => $key]);
		if(!$mSetting){
			$mSetting = self::initData([
				'keystr' => $key,
				'valuestr' => $value
			]);
		}
		$mSetting->set('valuestr', $value);
		return $mSetting->save();
	}
}