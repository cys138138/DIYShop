<?php
namespace home\controllers;

use Yii;
use home\lib\VenderController as VController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\form\ImageUploadForm;
use yii\web\UploadedFile;
use common\model\VenderShop;

class VenderShopController extends VController{

    public function actionShowSetting(){
		$mVender = Yii::$app->vender->getIdentity();
		$mVenderShop = VenderShop::findOne($mVender->id);
        return $this->render('setting', [
			'aVenderShop' => $mVenderShop ? $mVenderShop->toArray() : []
		]);
    }
	
	public function actionShowSetting(){
		
	}

	public function actionUploadFile(){
		$mVender = Yii::$app->vender->getIdentity();
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
		$savePath = Yii::getAlias('@p.vender_shop_img') . '/' . $mVender->id;
		if(!is_dir(Yii::getAlias('@p.resource') . $savePath)){
			@mkdir(Yii::getAlias('@p.resource') . $savePath);
		}

		$oForm->oImage = UploadedFile::getInstanceByName('image');
		if(!$oForm->upload($savePath)){
			$message = current($oForm->getErrors())[0];
			return new Response($message, 0);
		}else{
			return new Response('', 1, $oForm->savedFile);
		}
	}
}
