<?php
namespace common\model\form;

use Yii;
use common\model\Vender;
use yii\data\Pagination;

class VenderListForm extends \yii\base\Model{
	public $page = 1;
	public $pageSize = 15;
	public $venderId = 0;

	public function rules(){
		return [
			['page', 'compare', 'compareValue' => 0, 'operator' => '>'],
			['venderId', 'checkVenderId'],
		];
	}
	
	public function checkVenderId(){
		/*if($this->venderId){
			$mVender = Vender::findOne($this->venderId);
			if(!$mVender){
				$this->addError('venderId', '找不到商家信息');
				return false;
				
			}
		}*/
		return true;
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
		if($this->venderId){
			$aCondition['id'] = $this->venderId;
		}
		return $aCondition;
	}

	public function getPageObject(){
		$aCondition = $this->getListCondition();
		$count = Vender::getCount($aCondition);
		return new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);
	}
}