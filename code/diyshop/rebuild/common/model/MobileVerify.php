<?php
namespace common\model;
use Yii;
use umeworld\lib\Query;
class MobileVerify extends \common\lib\DbOrmModel{
	public static function tableName(){
		return Yii::$app->db->parseTable('_@mobile_verify'); 
	}
}
