<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\User;
use common\model\Vote;
use common\model\VoteRecord;

trait VoteApi{
	
	private function getVoteList(){
		$userToken = Yii::$app->request->post('user_token');
		
		if(!$userToken){
			return new Response('缺少user_token', 3601);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3602);
		}
		
		$aList = Vote::findAll();
		foreach($aList as $key => $aValue){
			if(strtotime($aValue['onSalesDay']) < NOW_TIME){
				$aList[$key]['isOnSale'] = 0;
			}else{
				$aList[$key]['isOnSale'] = 1;
			}
			$mVoteRecord = VoteRecord::findOne([
				'user_id' => $userId,
				'identity' => $aValue['identity'],
			]);
			if($mVoteRecord){
				$aList[$key]['isVote'] = 1;
			}else{
				$aList[$key]['isVote'] = 0;
			}
		}
		
		return new Response('投票列表', 1, $aList);
	}
	
	private function voteDress(){
		$userToken = Yii::$app->request->post('user_token');
		$identity = Yii::$app->request->post('identity');
		
		if(!$userToken){
			return new Response('缺少user_token', 3601);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3602);
		}
		
		$mVote = Vote::findOne(['identity' => $identity]);
		if(!$mVote){
			return new Response('找不到投票信息', 3603);
		}
		
		$mVoteRecord = VoteRecord::findOne([
			'user_id' => $userId,
			'identity' => $identity,
		]);
		if($mVoteRecord){
			return new Response('已投票', 3604);
		}
		$mVoteRecord = VoteRecord::insert([
			'user_id' => $userId,
			'identity' => $identity,
			'create_time' => NOW_TIME,
		]);
		if(!$mVoteRecord){
			return new Response('投票失败', 3605);
		}
		return new Response('投票成功', 1);
	}
	
	private function cancelVoteDress(){
		$userToken = Yii::$app->request->post('user_token');
		$identity = Yii::$app->request->post('identity');
		
		if(!$userToken){
			return new Response('缺少user_token', 3701);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 3702);
		}
		$mVoteRecord = VoteRecord::findOne([
			'user_id' => $userId,
			'identity' => $identity,
		]);
		if(!$mVoteRecord){
			return new Response('找不到投票信息', 3703);
		}
		if(!$mVoteRecord->delete()){
			return new Response('取消投票失败', 3704);
		}
		
		return new Response('取消投票成功', 1);
	}

}
