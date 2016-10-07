<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\Setting;
use common\model\Dress;

trait GuessLikeApi{
	
	private function getGuessLikeList(){
		$aList = json_decode(Setting::getSetting(Setting::GUESS_LIKE), true);
		$aDressIds = ArrayHelper::getColumn($aList, 'dress_id');
		$aDressList = Dress::getList(['id' => $aDressIds]);
		foreach($aList as $key => $aValue){
			foreach($aDressList as $k => $v){
				if($aValue['dress_id'] == $v['id']){
					$aList[$key]['dress_info'] = $v;
					break;
				}
			}
		}
		
		return new Response('猜你喜欢列表', 1, $aList);
	}

}
