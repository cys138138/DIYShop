<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class VenderShop extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = ['pics'];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@vender_shop');
	}
}