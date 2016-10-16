<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\Dress;
use common\model\DressComment;
use common\model\DressDecoration;
use common\model\DressCatalog;
use common\model\UserDressCollection;
use common\model\User;

trait DressApi{
	
	private function getDressList(){
		$userToken = Yii::$app->request->post('user_token');
		$page = Yii::$app->request->post('page');
		$pageSize = Yii::$app->request->post('page_size');
		$catalogId = Yii::$app->request->post('catalog_id');
		$sex = Yii::$app->request->post('sex');
		$status = Yii::$app->request->post('status');
		$keyword = Yii::$app->request->post('keyword');
		$isHot = Yii::$app->request->post('is_hot');
		
		if($page < 1){
			$page = 1;
		}
		if($pageSize < 1){
			$pageSize = 5;
		}
		
		if(!$userToken){
			return new Response('缺少user_token', 2801);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2802);
		}
		
		$aCondition = ['status' => $status];
		if($catalogId){
			$aCondition['catalog_id'] = $catalogId;
		}
		if($keyword){
			$aCondition['name'] = $keyword;
		}
		if($sex){
			$aCondition['sex'] = $sex;
		}
		if($isHot){
			$aCondition['is_hot'] = 1;
		}
		
		$aOrderBy = ['sale_count' => SORT_DESC, 'update_time' => SORT_DESC];
		
		$aControl = [
			'page' => $page,
			'page_size' => $pageSize,
			'order_by' => $aOrderBy,
		];
		$aList = Dress::getList($aCondition, $aControl);
		$aList = $this->_appendUserDressCollectionInfo($userId, $aList);
		
		return new Response('服饰列表', 1, $aList);
	}
	
	private function getDressDetail(){
		$userToken = Yii::$app->request->post('user_token');
		$dressId = Yii::$app->request->post('dress_id');
		
		if(!$userToken){
			return new Response('缺少user_token', 2801);
		}
		$userId = $this->_getUserIdByUserToken($userToken);
		$mUser = User::findOne($userId);
		if(!$mUser){
			return new Response('找不到用户信息', 2802);
		}
		
		$aCondition = ['id' => $dressId];
		
		$aControl = [];
		$aList = Dress::getList($aCondition, $aControl);
		if(!$aList){
			return new Response('找不到服饰', 2801);
		}
		$aList = $this->_appendUserDressCollectionInfo($userId, $aList);
		
		return new Response('服饰详细', 1, $aList[0]);
	}
	
	private function _appendUserDressCollectionInfo($userId, $aList){
		if(!$aList){
			return [];
		}
		$aDressIds = ArrayHelper::getColumn($aList, 'id');
		$aUserDressCollectionList = UserDressCollection::findAll([
			'user_id' => $userId,
			'dress_id' => $aDressIds,
		]);
		
		foreach($aList as $key => $aValue){
			$aList[$key]['is_collection'] = 0;
			foreach($aUserDressCollectionList as $k => $v){
				if($v['dress_id'] == $aValue['id']){
					$aList[$key]['is_collection'] = 1;
					break;
				}
			}
		}
		
		return $aList;
	}
	
	private function getDressCommentList(){
		$page = Yii::$app->request->post('page');
		$pageSize = Yii::$app->request->post('page_size');
		$dressId = Yii::$app->request->post('dress_id');
		
		if($page < 1){
			$page = 1;
		}
		if($pageSize < 1){
			$pageSize = 5;
		}
		$mDress = Dress::findOne($dressId);
		if(!$mDress){
			return new Response('找不到服饰', 2701);
		}
		$aCondition = ['dress_id' => $dressId];
		
		$aControl = [
			'page' => $page,
			'page_size' => $pageSize,
			'order_by' => ['create_time' => SORT_DESC],
		];
		$aList = DressComment::getList($aCondition, $aControl);
		
		return new Response('服饰评论列表', 1, $aList);	
	}
	
	private function getDressDecorationList(){
		$page = Yii::$app->request->post('page');
		$pageSize = Yii::$app->request->post('page_size');
		
		if($page < 1){
			$page = 1;
		}
		if($pageSize < 1){
			$pageSize = 5;
		}
		
		$aCondition = [];
		
		$aControl = [
			'page' => $page,
			'page_size' => $pageSize,
			'order_by' => ['create_time' => SORT_DESC],
		];
		$aList = DressDecoration::getList($aCondition, $aControl);
		
		return new Response('饰件列表', 1, $aList);	
	}
	
	private function getDressCatalogTree(){
		$aList = DressCatalog::getDressCatalogTree();
		
		return new Response('服饰分类树', 1, $aList);	
	}
	
}
