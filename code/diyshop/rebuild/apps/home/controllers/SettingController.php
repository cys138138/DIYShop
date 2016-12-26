<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\form\ImageUploadForm;
use yii\web\UploadedFile;
use common\model\Setting;

class SettingController extends MController{
	const DATA_SETTING_KEY = Setting::IS_SHOW_ADVERTISEMENT;

	private function _getIsShowAdvertisement(){
		return Setting::getSetting(self::DATA_SETTING_KEY);
	}

	private function _setIsShowAdvertisement($aData){
		return Setting::setSetting(self::DATA_SETTING_KEY, $aData);
	}

    public function actionIndex(){
		return $this->render('index', [
			'isShowAdvertisement' => $this->_getIsShowAdvertisement()
		]);
    }
	
	public function actionSaveIsShowAdvertisement(){
		$isShowAdvertisement = (int)Yii::$app->request->post('isShowAdvertisement');
		
		$isSuccess = $this->_setIsShowAdvertisement($isShowAdvertisement ? 1 : 0);
		if(!$isSuccess){
			return new Response('设置失败', 0);
		}
		return new Response('设置成功', 1);
	}
	
}
