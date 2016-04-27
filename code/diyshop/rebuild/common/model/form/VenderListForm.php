<?php
namespace common\model\form;

use Yii;
use common\model\Vender;
use yii\data\Pagination;

class VenderListForm extends \yii\base\Model{
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
		$aList = Vender::getList($aCondition, $aControl);

		return $aList;
	}

	public function getListCondition(){
		$aCondition = [];
		/*if($this->id){
			$aCondition['id'] = $this->id;
		}*/
		return $aCondition;
	}

	public function getPageObject(){
		$aCondition = $this->getListCondition();
		$count = Vender::getCount($aCondition);
		return new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);
	}
}