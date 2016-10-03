<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\form\ImageUploadForm;
use yii\web\UploadedFile;
use common\model\Setting;

class BgAdvertisementController extends MController{
	const DATA_SETTING_KEY = 'bg_advertisement_config';

	private function _getBgAdvertisementConfig(){
		return json_decode(Setting::getSetting(self::DATA_SETTING_KEY), true);
	}

	private function _setBgAdvertisementConfig($aData){
		return Setting::setSetting(self::DATA_SETTING_KEY, json_encode($aData));
	}

    public function actionShowManageBgAdv(){
		return $this->render('show-manage', [
			'aBgAdvertisementConfig' => $this->_getBgAdvertisementConfig()
		]);
    }
	
	public function actionSaveAdvertisementConfig(){
		$aBgAdvertisementConfig = (array)Yii::$app->request->post('aData');
		$isSuccess = $this->_setBgAdvertisementConfig($aBgAdvertisementConfig);
		if(!$isSuccess){
			return new Response('保存失败', 0);
		}
		return new Response('保存成功', 1);
	}
	
	public function actionUploadFile(){
		$oForm = new ImageUploadForm();
		$oForm->fCustomValidator = function($oForm){
			list($width, $height) = getimagesize($oForm->oImage->tempName);
			/*if($width != 340 || $height != 235){
				$oForm->addError('oImage', '图片宽高应为340px*235px');
				return false;
			}*/
			return true;
		};
		
		$isUploadFromUEditor = false;
		$savePath = Yii::getAlias('@p.advertisement_position_img');

		$oForm->oImage = UploadedFile::getInstanceByName('image');
		if(!$oForm->upload($savePath)){
			$message = current($oForm->getErrors())[0];
			return new Response($message, 0);
		}else{
			return new Response('', 1, $oForm->savedFile);
		}
	}

}
