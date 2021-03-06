<?php
namespace common\model\form;

use Yii;
use common\model\ManagerDressMatch;
use yii\data\Pagination;

class ManagerDressMatchListForm extends \yii\base\Model{
	public $page = 1;
	public $pageSize = 15;

	public function rules(){
		return [
			['page', 'compare', 'compareValue' => 0, 'operator' => '>'],
		];
	}

	public function getList(){
		$aCondition = $this->getListCondition();
		$aControl = [
			'page' => $this->page,
			'page_size' => $this->pageSize,
		];
		$aList = ManagerDressMatch::getList($aCondition, $aControl);

		return $aList;
	}

	public function getListCondition(){
		$aCondition = [];
		return $aCondition;
	}

	public function getPageObject(){
		$aCondition = $this->getListCondition();
		$count = ManagerDressMatch::getCount($aCondition);
		return new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);
	}
}