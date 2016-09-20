<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class UserAddGoldRecord extends \common\lib\DbOrmModel{
	
	const USER_TYPE_MANAGER = 0;	//管理员
	const USER_TYPE_VENDER = 1;		//商家
	
	public static function tableName(){
		return Yii::$app->db->parseTable('_@user_add_gold_record');
	}
}