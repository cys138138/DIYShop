<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class ReturnExchange extends \common\lib\DbOrmModel{
	
	const TYPE_RETURN_AND_EXCHANGE = 1;	//退货退款
	const TYPE_RETURN_MONEY = 2;		//仅退款
	const TYPE_RETURN_GOODS = 3;		//仅换货
	
	protected $_aEncodeFields = ['pics'];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@return_exchange');
	}
	
}