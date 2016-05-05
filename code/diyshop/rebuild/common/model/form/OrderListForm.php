<?php
namespace common\model\form;

use Yii;
use common\model\Order;
use yii\data\Pagination;

class OrderListForm extends \yii\base\Model{
	public $page = 1;
	public $pageSize = 15;
	public $orderNumber = 0;

	public function rules(){
		return [
			['page', 'compare', 'compareValue' => 0, 'operator' => '>'],
			['orderNumber', 'checkOrderNumber'],
		];
	}
	
	public function checkOrderNumber(){
		return true;
	}

	public function getList(){
		$aCondition = $this->getListCondition();
		$aControl = [
			'page' => $this->page,
			'page_size' => $this->pageSize,
		];
		$aList = Order::getList($aCondition, $aControl);

		return $aList;
	}

	public function getListCondition(){
		$aCondition = [];
		if($this->orderNumber){
			$aCondition['order_number'] = $this->orderNumber;
		}
		return $aCondition;
	}

	public function getPageObject(){
		$aCondition = $this->getListCondition();
		$count = Order::getCount($aCondition);
		return new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);
	}
}