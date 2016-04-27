<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\form\ImageUploadForm;
use yii\web\UploadedFile;
use common\model\Setting;

class AdvertisementController extends MController{
	const DATA_SETTING_KEY = 'advertisement_catalog_config';

	private function _getAdvertisementCatalogConfig(){
		return json_decode(Setting::getSetting(self::DATA_SETTING_KEY), true);
	}

	private function _setAdvertisementCatalogConfig($aData){
		return Setting::setSetting(self::DATA_SETTING_KEY, json_encode($aData));
	}

    public function actionShowManageAdvertisement(){
		return $this->render('show-manage', [
			'aAdvertisementCatalogConfig' => $this->_getAdvertisementCatalogConfig()
		]);
    }
	
    public function actionShowList(){
		return $this->render('show-list', [
			'aAdvertisementCatalogConfig' => $this->_getAdvertisementCatalogConfig()
		]);
    }
	
    public function actionShowEdit(){
		$id = (int)Yii::$app->request->get('id');
		$aAdvertisementCatalog = [];
		foreach($this->_getAdvertisementCatalogConfig() as $aValue){
			if($aValue['id'] == $id){
				$aAdvertisementCatalog = $aValue;
				break;
			}
		}
		return $this->render('show-edit', [
			'aAdvertisementCatalog' => $aAdvertisementCatalog
		]);
    }
	
	public function actionSave(){
		$id = (int)Yii::$app->request->post('id');
		$name = (string)Yii::$app->request->post('name');
		if(!$name){
			return new Response('请填写分类名称', -1);
		}
		$aAdvertisementCatalogConfig = $this->_getAdvertisementCatalogConfig();
		$aAdvertisementCatalog = [];
		$maxId = 0;
		$isSuccess = false;
		foreach($aAdvertisementCatalogConfig as $key => $aValue){
			if($aValue['id'] > $maxId){
				$maxId = $aValue['id'];
			}
			if($aValue['id'] == $id){
				$aAdvertisementCatalogConfig[$key]['name'] = $name;
				$isSuccess = $this->_setAdvertisementCatalogConfig($aAdvertisementCatalogConfig);
				$aAdvertisementCatalog = $aAdvertisementCatalogConfig[$key];
			}
		}
		if(!$aAdvertisementCatalog){
			$aAdvertisementCatalog = [
				'id' => $maxId + 1,
				'name' => $name,
				'pics' => []
			];
			array_push($aAdvertisementCatalogConfig, $aAdvertisementCatalog);
			$isSuccess = $this->_setAdvertisementCatalogConfig($aAdvertisementCatalogConfig);
		}
		if(!$isSuccess){
			return new Response('保存失败', 0);
		}
		return new Response('保存成功', 1);
	}
	
	public function actionDelete(){
		$id = (int)Yii::$app->request->post('id');
		
		$aAdvertisementCatalogConfig = $this->_getAdvertisementCatalogConfig();
		$aNewAdvertisementCatalogConfig = [];
		$isFind = false;
		foreach($aAdvertisementCatalogConfig as $key => $aValue){
			if($aValue['id'] != $id){
				array_push($aNewAdvertisementCatalogConfig, $aValue);
			}else{
				$isFind = true;
			}
		}
		if(!$isFind){
			return new Response('找不到要删除的数据', 0);
		}
		$isSuccess = $this->_setAdvertisementCatalogConfig($aNewAdvertisementCatalogConfig);
		if(!$isSuccess){
			return new Response('删除失败', 0);
		}
		return new Response('删除成功', 1);
	}
	
	public function actionSaveAdvertisementCatalogConfig(){
		$aAdvertisementCatalogConfig = (array)Yii::$app->request->post('aData');
		$isSuccess = $this->_setAdvertisementCatalogConfig($aAdvertisementCatalogConfig);
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
