<?php
namespace home\controllers;

use Yii;
use home\lib\VenderController as VController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\Order;
use common\model\form\OrderListForm;

class OrderManageController extends VController{
	
    public function actionShowList(){
		$oOrderListForm = new OrderListForm();
		$aParams = Yii::$app->request->get();
		if($aParams && (!$oOrderListForm->load($aParams, '') || !$oOrderListForm->validate())){
			return new Response(current($oOrderListForm->getErrors())[0]);
		}
		$aList = $oOrderListForm->getList();
		$oPage = $oOrderListForm->getPageObject();
		$aKuaiDiCompanyList = Yii::$app->kuaidi->getTypeList();
		
		return $this->render('show-list', [
			'orderNumber' => $oOrderListForm->orderNumber,
			'aOrderList' => $aList,
			'aKuaiDiCompanyList' => $aKuaiDiCompanyList,
			'oPage' => $oPage,
		]);
    }
	
	public function actionSaveExpressInfo(){
		$id = (int)Yii::$app->request->post('id');
		$expressType = (string)Yii::$app->request->post('expressType');
		$expressNumber = (string)Yii::$app->request->post('expressNumber');
		
		$aKuaiDiCompanyList = Yii::$app->kuaidi->getTypeList();
		if(!isset($aKuaiDiCompanyList[$expressType])){
			return new Response('快递公司错误', 0);
		}
		
		$mOrder = Order::findOne($id);
		if(!$mOrder){
			return new Response('找不到订单信息', 0);
		}
		$mOrder->set('express_info', [
			'express_type' => $expressType,
			'express_number' => $expressNumber,
			'express_name' => $aKuaiDiCompanyList[$expressType]['name'],
		]);
		if(!$mOrder->save()){
			return new Response('保存失败', 0);
		}
		return new Response('保存成功', 1);
	}
	
	public function actionSureSendGoods(){
		$id = (int)Yii::$app->request->post('id');
		
		$mOrder = Order::findOne($id);
		if(!$mOrder){
			return new Response('找不到订单信息', 0);
		}
		if($mOrder->status != Order::ORDER_STATUS_WAIT_SEND){
			return new Response('订单不是在待发货状态', 0);
		}
		$mOrder->set('status', Order::ORDER_STATUS_WAIT_RECEIVE);
		$mOrder->save();
		
		return new Response('操作成功', 1);
	}
	
}
