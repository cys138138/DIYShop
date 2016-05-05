<?php
namespace home\controllers;

use Yii;
use home\lib\VenderController as VController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\Order;
use common\model\form\OrderListForm;
use yii\validators\EmailValidator;
use umeworld\lib\PhoneValidator;

class OrderManageController extends VController{
	
    public function actionShowList(){
		$oOrderListForm = new OrderListForm();
		$aParams = Yii::$app->request->get();
		if($aParams && (!$oOrderListForm->load($aParams, '') || !$oOrderListForm->validate())){
			return new Response(current($oOrderListForm->getErrors())[0]);
		}
		$aList = $oOrderListForm->getList();
		$oPage = $oOrderListForm->getPageObject();
		
		return $this->render('show-list', [
			'orderNumber' => $oOrderListForm->orderNumber,
			'aOrderList' => $aList,
			'oPage' => $oPage,
		]);
    }
	
}
