<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\SystemSns;
use common\model\User;

trait SystemSnsApi{
	
	private function getSystemSnsList(){
		$userToken = Yii::$app->request->post('user_token');
		$page = Yii::$app->request->post('page');
		$pageSize = Yii::$app->request->post('page_size');
		
		if($page < 1){
			$page = 1;
		}
		if($pageSize < 1){
			$pageSize = 5;
		}
		
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 4301);
		}
		
		$aCondition = [
			'user_id' => $userId,
			'with_default_record' => true,
		];
		$aControl = [
			'page' => $page,
			'page_size' => $pageSize,
			'order_by' => ['create_time' => SORT_DESC],
		];
		$aList = SystemSns::getList($aCondition, $aControl);
		
		return new Response('系统通知列表', 1, $aList);
	}

}
