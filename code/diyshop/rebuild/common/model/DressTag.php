<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class DressTag extends \common\lib\DbOrmModel{

	public static function tableName(){
		return Yii::$app->db->parseTable('_@dress_tag');
	}
}