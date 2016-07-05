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
	
	public function actionSaveSetting(){
		$name = (string)Yii::$app->request->post('name');
		$description = (string)Yii::$app->request->post('description');
		$logo = (string)Yii::$app->request->post('logo');
		$kefuTel = (string)Yii::$app->request->post('kefuTel');
		$aPics = (array)Yii::$app->request->post('aPics');
		
		if(!$name){
			return new Response('请填写商店名称', -1);
		}
		if(!$description){
			return new Response('请填写商店说明', -1);
		}
		if(!$logo){
			return new Response('请上传商店Logo', -1);
		}
		
		$mVender = Yii::$app->vender->getIdentity();
		$mVenderShop = VenderShop::findOne($mVender->id);
		$isSuccess = false;
		if(!$mVenderShop){
			$isSuccess = VenderShop::insert([
				'id' => $mVender->id,
				'name' => $name,
				'logo' => $logo,
				'kefu_tel' => $kefuTel,
				'description' => $description,
				'pics' => $aPics,
			]);
		}else{
			$mVenderShop->set('name', $name);
			$mVenderShop->set('logo', $logo);
			$mVenderShop->set('kefu_tel', $kefuTel);
			$mVenderShop->set('description', $description);
			$mVenderShop->set('pics', $aPics);
			$mVenderShop->save();
			$isSuccess = true;
		}
		if(!$isSuccess){
			return new Response('保存失败', 0);
		}
		return new Response('保存成功', 1);
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
		$savePath = Yii::getAlias('@p.vender_shop_img') . '/' . mt_rand(10, 99);
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
