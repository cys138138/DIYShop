<?php
namespace home\controllers;

use Yii;
use home\lib\ManagerController as MController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\DressDecoration;
use common\model\form\ImageUploadForm;
use yii\web\UploadedFile;

class ManagerDressDecorationController extends MController{
	
    public function actionShowList(){
		$aList = DressDecoration::findAll();
		
		return $this->render('show-list', ['aList' => $aList]);
    }
	
	public function actionShowEdit(){
		$id = (int)Yii::$app->request->get('id');
		$aDressDecoration = [];
		$mDressDecoration = DressDecoration::findOne($id);
		if($mDressDecoration){
			$aDressDecoration = $mDressDecoration->toArray();
		}
		return $this->render('show-edit', [
			'aDressDecoration' => $aDressDecoration
		]);
    }
	
	public function actionSave(){
		$id = (int)Yii::$app->request->post('id');
		$name = (string)Yii::$app->request->post('name');
		$effectPic = (string)Yii::$app->request->post('effectPic');
		$aDetailPics = (array)Yii::$app->request->post('aDetailPics');
		
		if(!$name){
			return new Response('请输入饰件名称', 0);
		}
		if($id){
			$mDressDecoration = DressDecoration::findOne($id);
			if($mDressDecoration){
				$mDressDecoration->set('name', $name);
				$mDressDecoration->set('detail_pics', $aDetailPics);
				$mDressDecoration->set('effect_pic', $effectPic);
				$mDressDecoration->save();
			}else{
				return new Response('找不到饰件信息', 0);
			}
		}else{
			$isSuccess = DressDecoration::insert([
				'name' => $name,
				'detail_pics' => $aDetailPics,
				'effect_pic' => $effectPic,
			]);
			if(!$isSuccess){
				return new Response('保存失败', 0);
			}
		}
		return new Response('保存成功', 1);
    }
	
	public function actionDelete(){
		$id = (int)Yii::$app->request->post('id');
		
		$mDressDecoration = DressDecoration::findOne($id);
		if(!$mDressDecoration){
			return new Response('找不到饰件信息', 0);
		}
		$mDressDecoration->delete();
		
		return new Response('删除成功', 1);
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
		$savePath = Yii::getAlias('@p.dress') . '/' . mt_rand(10, 99);
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
