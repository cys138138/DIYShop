<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;
use yii\helpers\ArrayHelper;
use common\model\Setting;

trait AdvertisementApi{
	
	private function getHomePageAdvertisement(){
		$isShowAdvertisement = Setting::getSetting(self::IS_SHOW_ADVERTISEMENT);
		$aTopAdertisement = json_decode(Setting::getSetting(Setting::TOP_ADVERTISEMENT), true);
		$aBgAdertisement = json_decode(Setting::getSetting(Setting::BG_ADVERTISEMENT), true);
		
		return new Response('首页广告图片', 1, [
			'top' => $aTopAdertisement,
			'bg' => $aBgAdertisement,
			'is_show_advertisement' => $isShowAdvertisement,
		]);
	}

}
