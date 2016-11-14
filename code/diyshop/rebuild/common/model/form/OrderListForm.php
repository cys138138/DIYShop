<?php
namespace common\model\form;

use Yii;
use common\model\Order;
use yii\data\Pagination;

class OrderListForm extends \yii\base\Model{
	public $page = 1;
	public $pageSize = 15;
	public $orderNumber = 0;
	public $status = 0;

	public function rules(){
		return [
			['page', 'compare', 'compareValue' => 0, 'operator' => '>'],
			['orderNumber', 'checkOrderNumber'],
			['status', 'checkStatus'],
		];
	}
	
	public function checkOrderNumber(){
		return true;
	}

	public function checkStatus(){
		return true;
	}

	public function getList(){
		$aCondition = $this->getListCondition();
		$aControl = [
			'page' => $this->page,
			'page_size' => $this->pageSize,
			'order_by' => ['create_time' => SORT_DESC],
		];
		$aList = Order::getList($aCondition, $aControl);

		return $aList;
	}

	public function getListCondition(){
		$mVender = Yii::$app->vender->getIdentity();
		$aCondition = [
			'order_type' => 0,
			'vender_id' => $mVender->id,
		];
		if($this->orderNumber){
			$aCondition['order_number'] = $this->orderNumber;
		}
		if($this->status){
			$aCondition['status'] = $this->status;
		}
		return $aCondition;
	}

	public function getPageObject(){
		$aCondition = $this->getListCondition();
		$count = Order::getCount($aCondition);
		return new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);
	}
}