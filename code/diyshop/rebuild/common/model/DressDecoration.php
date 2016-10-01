<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class DressDecoration extends \common\lib\DbOrmModel{
	
	protected $_aEncodeFields = ['detail_pics'];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@dress_decoration');
	}
}