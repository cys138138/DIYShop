<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\form\ImageUploadForm;
use yii\web\UploadedFile;

class AdvertisementController extends MController{

    public function actionShowManageAdvertisement(){
        return $this->render('show-manage', [
			'aAdvertisementCatalogConfig' => Yii::$app->params['advertisement_catalog_config']
		]);
    }
	
	public function actionUploadFile(){
		$oForm = new ImageUploadForm();
		$isUploadFromUEditor = false;
		$savePath = null;
		if(Yii::$app->request->post('isBigMatch')){
			$oForm->fCustomValidator = function($oForm){
				list($width, $height) = getimagesize($oForm->oImage->tempName);
				if($width != 340 || $height != 235){
					$oForm->addError('oImage', '图片宽高应为340px*235px');
					return false;
				}
				return true;
			};

		}elseif(Yii::$app->request->post('isNormalMatch')){
			$oForm->fCustomValidator = function($oForm){
				list($width, $height) = getimagesize($oForm->oImage->tempName);
				if($width > 400 || $height > 400){
					$oForm->addError('oImage', '最大宽度不能超过400px');
					return false;
				}

				if($width / $height != 0.9){
					$oForm->addError('oImage', '图片宽高比为9:10');
					return false;
				}
				return true;
			};

		}elseif(Yii::$app->request->post('isUploadWinner')){
			$oForm->fCustomValidator = function($oForm){
				list($width, $height) = getimagesize($oForm->oImage->tempName);
				if($width != $height){
					$oForm->addError('oImage', '图片宽高比为1:1');
					return false;
				}
				return true;
			};

		}else{
			$isUploadFromUEditor = true;
			$savePath = Yii::getAlias('@p.match_desc_img');
		}

		$oForm->oImage = UploadedFile::getInstanceByName('image');
		if(!$oForm->upload($savePath)){
			$message = current($oForm->getErrors())[0];
			if($isUploadFromUEditor){
				return $message;
			}else{
				return new Response($message);
			}
		}else{
			if($isUploadFromUEditor){
				if(Yii::$app->request->isAjax){
					return '/' . $oForm->savedFile;
				}

				$editorId = Yii::$app->request->get('editorid');
				return "<script>parent.UM.getEditor('". $editorId ."').getWidgetCallback('image')('/" . $oForm->savedFile . "','" . 'SUCCESS' . "')</script>";
			}else{
				return new Response('', 1, $oForm->savedFile);
			}
		}
	}

}
