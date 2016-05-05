<?php
namespace common\model\form;

use Yii;
use common\model\User;
use yii\data\Pagination;

class UserListForm extends \yii\base\Model{
	public $page = 1;
	public $pageSize = 15;
	public $userId = 0;

	public function rules(){
		return [
			['page', 'compare', 'compareValue' => 0, 'operator' => '>'],
			['userId', 'checkUserId'],
		];
	}
	
	public function checkUserId(){
		return true;
	}

	public function getList(){
		$aCondition = $this->getListCondition();
		$aControl = [
			'page' => $this->page,
			'page_size' => $this->pageSize,
		];
		$aList = User::getList($aCondition, $aControl);

		return $aList;
	}

	public function getListCondition(){
		$aCondition = [];
		if($this->userId){
			$aCondition['id'] = $this->userId;
		}
		return $aCondition;
	}

	public function getPageObject(){
		$aCondition = $this->getListCondition();
		$count = User::getCount($aCondition);
		return new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);
	}
}