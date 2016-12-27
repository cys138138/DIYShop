<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\Setting;

trait AdvertisementApi{
	
	private function getHomePageAdvertisement(){
		$isShowAdvertisement = Setting::getSetting(Setting::IS_SHOW_ADVERTISEMENT);
		$aTopAdertisement = json_decode(Setting::getSetting(Setting::TOP_ADVERTISEMENT), true);
		$aBgAdertisement = json_decode(Setting::getSetting(Setting::BG_ADVERTISEMENT), true);
		$aReturn = [
			'top' => $aTopAdertisement,
			'bg' => $aBgAdertisement,
			'is_show_advertisement' => $isShowAdvertisement,
		];
		if(Yii::$app->request->post('version') == '1.0.0'){
			$aOldTopAdertisement = [];
			foreach($aTopAdertisement as $aValue){
				array_push($aOldTopAdertisement, $aValue['pic']);
			}
			$aOldBgAdertisement = [];
			foreach($aBgAdertisement as $aValue){
				array_push($aOldBgAdertisement, $aValue['pic']);
			}
			$aReturn = [
				'top' => $aOldTopAdertisement,
				'bg' => $aOldBgAdertisement,
				'is_show_advertisement' => $isShowAdvertisement,
			];
		}
		return new Response('首页广告图片', 1, [
			'top' => $aTopAdertisement,
			'bg' => $aBgAdertisement,
			'is_show_advertisement' => $isShowAdvertisement,
		]);
	}

}
