<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\Setting;

trait VoteApi{
	
	private function getVoteList(){
		$aList = json_decode(Setting::getSetting(Setting::VOTE), true);
		foreach($aList as $key => $aValue){
			if(strtotime($aValue['onSalesDay']) < NOW_TIME){
				$aList[$key]['isOnSale'] = 0;
			}else{
				$aList[$key]['isOnSale'] = 1;
			}
		}
		
		return new Response('投票列表', 1, $aList);
	}

}
