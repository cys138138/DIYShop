<?php
namespace common\model\form;

use Yii;
use common\model\Dress;
use yii\data\Pagination;

class DressListForm extends \yii\base\Model{
	public $page = 1;
	public $pageSize = 15;
	public $dressId = 0;

	public function rules(){
		return [
			['page', 'compare', 'compareValue' => 0, 'operator' => '>'],
			['dressId', 'checkDressId'],
		];
	}
	
	public function checkDressId(){
		return true;
	}

	public function getList(){
		$aCondition = $this->getListCondition();
		$aControl = [
			'page' => $this->page,
			'page_size' => $this->pageSize,
		];
		$aList = Dress::getList($aCondition, $aControl);

		return $aList;
	}

	public function getListCondition(){
		$mVender = Yii::$app->vender->getIdentity();
		$aCondition = ['vender_id' => $mVender->id];
		if($this->dressId){
			$aCondition['id'] = $this->dressId;
		}
		return $aCondition;
	}

	public function getPageObject(){
		$aCondition = $this->getListCondition();
		$count = Dress::getCount($aCondition);
		return new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);
	}
}