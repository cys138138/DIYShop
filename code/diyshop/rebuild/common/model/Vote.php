<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class Vote extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = ['aSize', 'pic'];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@vote');
	}
	
}