<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\Setting;
use common\model\User;
use common\model\VoteRecord;

trait ConfigApi{
	
	private function getQiniuToken(){
		return new Response('七牛token', 1, [
			'token' => Yii::$app->qiniu->getUploadToken(),
			'domain' => Yii::$app->qiniu->privateDomain,
		]);
	}
	
}
