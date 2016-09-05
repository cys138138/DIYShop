<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\Dress;
use common\model\DressComment;

trait DressApi{
	
	private function getDressList(){
		$page = Yii::$app->request->post('page');
		$pageSize = Yii::$app->request->post('page_size');
		$keyword = Yii::$app->request->post('keyword');
		
		if($page < 1){
			$page = 1;
		}
		if($pageSize < 1){
			$pageSize = 5;
		}
		
		$aCondition = [];
		if($keyword){
			$aCondition['name'] = $keyword;
		}
		
		$aControl = [
			'page' => $page,
			'page_size' => $pageSize,
			//'order_by' => ['create_time' => SORT_DESC],
		];
		$aList = Dress::getList($aCondition, $aControl);
		
		return new Response('服饰列表', 1, $aList);
	}
	
	private function getDressDetail(){
		$dressId = Yii::$app->request->post('dress_id');
		
		$aCondition = ['id' => $dressId];
		
		$aControl = [];
		$aList = Dress::getList($aCondition, $aControl);
		if(!$aList){
			return new Response('找不到服饰', 2801);
		}
		
		return new Response('服饰详细', 1, $aList[0]);
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
	
}
