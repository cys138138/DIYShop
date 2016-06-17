<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class VoteRecord extends \common\lib\DbOrmModel{
	protected $_aEncodeFields = [];

	public static function tableName(){
		return Yii::$app->db->parseTable('_@vote_record');
	}
	
	public static function getVoteCountByIdentity($identity){
		return (new Query())->from(self::tableName())->where([
			'and',
			['identity' => $identity]
		])->count();
	}
	
	
}