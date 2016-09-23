<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class DressSizeColorCount extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = ['pic', 'pics'];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@dress_size_color_count');
	}
}