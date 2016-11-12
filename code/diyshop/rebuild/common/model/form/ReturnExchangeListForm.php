<?php
namespace common\model\form;

use Yii;
use common\model\ReturnExchange;
use yii\data\Pagination;

class ReturnExchangeListForm extends \yii\base\Model{
	public $page = 1;
	public $pageSize = 15;
	public $userId = 0;
	public $orderNumber = '';
	public $type = 0;
	public $isHandle = 0;

	public function rules(){
		return [
			['page', 'compare', 'compareValue' => 0, 'operator' => '>'],
			['userId', 'checkUserId'],
			['orderNumber', 'checkOrderNumber'],
			['type', 'checkType'],
			['isHandle', 'checkIsHandle'],
		];
	}
	
	public function checkUserId(){
		return true;
	}

	public function checkOrderNumber(){
		return true;
	}

	public function checkType(){
		return true;
	}

	public function checkIsHandle(){
		return true;
	}

	public function getList(){
		$aCondition = $this->getListCondition();
		$aControl = [
			'page' => $this->page,
			'page_size' => $this->pageSize,
		];
		$aList = ReturnExchange::getList($aCondition, $aControl);

		return $aList;
	}

	public function getListCondition(){
		$mVender = Yii::$app->vender->getIdentity();
		$aCondition = [
			'vender_id' => $mVender->id,
			'is_handle' => $this->isHandle,
		];
		if($this->type){
			$aCondition['type'] = $this->type;
		}
		if($this->userId){
			$aCondition['user_id'] = $this->userId;
		}
		if($this->orderNumber){
			$aCondition['order_number'] = $this->orderNumber;
		}
		return $aCondition;
	}

	public function getPageObject(){
		$aCondition = $this->getListCondition();
		$count = ReturnExchange::getCount($aCondition);
		return new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);
	}
}