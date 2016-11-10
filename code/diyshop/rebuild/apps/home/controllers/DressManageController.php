<?php
namespace home\controllers;

use Yii;
use home\lib\VenderController as VController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use umeworld\lib\Http;
use common\model\DressCatalog;
use common\model\DressComment;
use common\model\DressTag;
use common\model\DressSizeColorCount;
use common\model\Dress;
use common\model\Vote;
use common\model\UserDressCollection;
use common\model\VenderDressMatch;
use common\model\ManagerDressMatch;
use common\model\form\DressListForm;
use common\model\form\ImageUploadForm;
use yii\web\UploadedFile;
use umeworld\lib\Xxtea;

class DressManageController extends VController{
	
    public function actionShowList(){
		//处理失效订单，将3日前的订单失效，并调整库存
		Http::sendNotWaitGetRequest(Yii::$app->urlManagerHome->createUrl(['site/order-failure']), ['vender_id' => Yii::$app->vender->id]);
		$oDressListForm = new DressListForm();
		$aParams = Yii::$app->request->get();
		if($aParams && (!$oDressListForm->load($aParams, '') || !$oDressListForm->validate())){
			return new Response(current($oDressListForm->getErrors())[0]);
		}
		$aList = $oDressListForm->getList();
		$oPage = $oDressListForm->getPageObject();
		
		return $this->render('show-list', [
			'dressId' => $oDressListForm->dressId,
			'aDressList' => $aList,
			'oPage' => $oPage,
		]);
    }
	
    public function actionShowEdit(){
		$id = (int)Yii::$app->request->get('id');
		
		$aDress = [];
		if($id){
			$mDress = Dress::findOne($id);
			if($mDress){
				$aDress = $mDress->toArray();
			}
		}
		$aList = DressCatalog::findAll();
		$aDressCatalogChildList = [];
		$aDressCatalogList = [];
		$aDressCatalogIdList = [];
		foreach($aList as $key => $aValue){
			array_push($aDressCatalogIdList, $aValue['id']);
			if(!$aValue['pid']){
				array_push($aDressCatalogList, $aValue);
			}else{
				array_push($aDressCatalogChildList, $aValue);
			}
		}
		$aManagerDressMatchList = ManagerDressMatch::findAll(['id' => $aDressCatalogIdList]);
		return $this->render('show-edit', [
			'aDressCatalogList' => $aDressCatalogList,
			'aManagerDressMatchList' => $aManagerDressMatchList,
			'aDressCatalogChildList' => $aDressCatalogChildList,
			'aDress' => $aDress,
			'aTagList' => Dress::getTagList(Yii::$app->vender->id),
			'aMaterialList' => Dress::getMaterilaList(Yii::$app->vender->id),
			'aSizeColorList' => Dress::getSizeColorList(Yii::$app->vender->id),
			'aDressMatchList' => VenderDressMatch::findAll(['vender_id' => Yii::$app->vender->id]),
		]);
    }
	
	public function actionSave(){
		$id = (int)Yii::$app->request->post('id');
		$name = (string)Yii::$app->request->post('name');
		$desc = (string)Yii::$app->request->post('desc');
		$detail = (string)Yii::$app->request->post('detail');
		$shuoMing = (string)Yii::$app->request->post('shuoMing');
		$catalogId = (int)Yii::$app->request->post('catalogId');
		$price = (string)Yii::$app->request->post('price');
		$discountPrice = (string)Yii::$app->request->post('discountPrice');
		$status = (int)Yii::$app->request->post('status');
		$isHot = (int)Yii::$app->request->post('isHot');
		$sex = (int)Yii::$app->request->post('sex');
		$aSizeColorCount = (array)Yii::$app->request->post('aSizeColorCount');
		$aTag = (array)Yii::$app->request->post('aTag');
		$aMaterial = (array)Yii::$app->request->post('aMaterial');
		$aPics = (array)Yii::$app->request->post('aPics');
		$aDressMatchIds = (array)Yii::$app->request->post('aDressMatchIds');
		
		if(!$name){
			return new Response('请填写服饰名称', -1);
		}
		if(!DressCatalog::findOne($catalogId)){
			return new Response('请选择服饰分类', -1);
		}
		if(!is_numeric($price)){
			return new Response('服饰价格必须是数字', -1);
		}
		if(!is_numeric($discountPrice)){
			return new Response('优惠价格必须是数字', -1);
		}
		if(!in_array($status, [Dress::VOTE_STATUS, Dress::OFF_SALES_STATUS, Dress::ON_SALES_STATUS])){
			return new Response('服饰状态不正确', -1);
		}
		if(!in_array($sex, [Dress::DRESS_SEX_BOY, Dress::DRESS_SEX_GIRL])){
			return new Response('性别不正确', -1);
		}
		if($aSizeColorCount){
			$aTempList = [];
			foreach($aSizeColorCount as $key => $aValue){
				if(count($aSizeColorCount) != 1 && !$aValue['size'] && !$aValue['color'] && $aValue['count'] == ''){
					continue;
				}
				if(!$aValue['size']){
					return new Response('请填写第' . (intval($key) + 1) . '项尺码', -1, $aSizeColorCount);
				}
				if(!$aValue['color']){
					return new Response('请填写第' . (intval($key) + 1) . '项颜色', -1);
				}
				if($aValue['count'] == ''){
					return new Response('请填写第' . (intval($key) + 1) . '项数量', -1);
				}
				array_push($aTempList, $aValue);
			}
			$aSizeColorCount = $aTempList;
		}else{
			return new Response('请填写尺码颜色库存', -1);
		}
		if($aTag){
			if(count($aTag) > 3){
				return new Response('最多只能添加3个服饰标签', -1);
			}
			foreach($aTag as $key => $value){
				if(!$value){
					return new Response('服饰标签不能为空', -1);
				}
			}
		}else{
			return new Response('请添加服饰标签', -1);
		}
		if($aMaterial){
			if(count($aMaterial) > 3){
				return new Response('最多只能添加3个服饰面料', -1);
			}
			foreach($aMaterial as $key => $value){
				if(!$value){
					return new Response('服饰面料不能为空', -1);
				}
			}
		}else{
			return new Response('请添加服饰面料', -1);
		}
		$isSuccess = false;
		$mDress = null;
		$mVender = Yii::$app->vender->getIdentity();
		if($id){
			$mDress = Dress::findOne($id);
			if($mDress){
				$mDress->set('name', $name);
				$mDress->set('desc', $desc);
				$mDress->set('detail', $detail);
				$mDress->set('shuo_ming', $shuoMing);
				$mDress->set('catalog_id', $catalogId);
				$mDress->set('price', $price);
				$mDress->set('discount_price', $discountPrice);
				$mDress->set('pics', $aPics);
				$mDress->set('dress_match_ids', $aDressMatchIds);
				$mDress->set('status', $status);
				$mDress->set('is_hot', $isHot);
				$mDress->set('sex', $sex);
				$mDress->set('update_time', NOW_TIME);
				$mDress->save();
				$isSuccess = true;
			}
		}else{
			$isSuccess = Dress::insert([
				'name' => $name,
				'desc' => $desc,
				'detail' => $detail,
				'shuo_ming' => $shuoMing,
				'vender_id' => $mVender->id,
				'catalog_id' => $catalogId,
				'price' => $price,
				'discount_price' => $discountPrice,
				'pics' => $aPics,
				'dress_match_ids' => $aDressMatchIds,
				'sex' => $sex,
				'sale_count' => 0,
				'like_count' => 0,
				'update_time' => NOW_TIME,
				'status' => $status,
				'is_hot' => $isHot,
				'create_time' => NOW_TIME
			]);
			$mDress = Dress::findOne($isSuccess);
		}
		
		if(!$isSuccess){
			return new Response('保存失败', 0);
		}
		$mDress->saveSizeColorCount($aSizeColorCount);
		$mDress->saveTag($aTag);
		$mDress->saveMaterial($aMaterial);
		if($status == Dress::ON_SALES_STATUS){
			//服饰上架的时候看看这个服饰是否有投票用户，有的话jpush个消息给用户
			Http::sendNotWaitGetRequest(Yii::$app->urlManagerHome->createUrl(['site/dress-on-sale-jpush-to-user']), ['dress_id' => Xxtea::encrypt($mDress->id)]);
		}
		return new Response('保存成功', 1);
	}
	
	public function actionDelete(){
		$id = (int)Yii::$app->request->post('id');
		
		$mDress = Dress::findOne($id);
		if(!$mDress){
			return new Response('找不到服饰信息', 0);
		}
		
		$aList = Vote::findAll();
		foreach($aList as $key => $aValue){
			if($aValue['dress_id'] == $id){
				return new Response('此服饰不能删除，还有投票正在使用该服饰', 0);
			}
		}
		$isSuccess = $mDress->delete();
		if(!$isSuccess){
			return new Response('删除失败', 0);
		}
		
		Yii::$app->db->createCommand()->delete(UserDressCollection::tableName(), ['dress_id' => $id])->execute();	
		
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
			$editorId = Yii::$app->request->get('editorid');
			if($editorId){
				return "<script>parent.UM.getEditor('". $editorId ."').getWidgetCallback('image')('" . $oForm->savedFile . "','" . 'SUCCESS' . "')</script>";
			}
			return new Response('', 1, $oForm->savedFile);
		}
	}
}
