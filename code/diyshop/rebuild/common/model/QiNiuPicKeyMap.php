<?php
namespace common\model;

use Yii;
use umeworld\lib\Query;

class QiNiuPicKeyMap extends \common\lib\DbOrmModel{

	public static function tableName(){
		return Yii::$app->db->parseTable('_@qiniu_pic_key_map');
	}
}