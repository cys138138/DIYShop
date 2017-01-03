<?php
namespace home\controllers;

use Yii;
use home\lib\VenderController as VController;
use umeworld\lib\Response;
use umeworld\lib\Url;
use umeworld\lib\Http;
use common\model\Order;
use common\model\SystemSns;
use common\model\ReturnExchange;
use common\model\form\OrderListForm;
use common\model\form\ReturnExchangeListForm;

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
			'status' => $oOrderListForm->status,
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
		if($mOrder->vender_id != Yii::$app->vender->id){
			return new Response('非法操作', 0);
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
		if($mOrder->vender_id != Yii::$app->vender->id){
			return new Response('非法操作', 0);
		}
		if($mOrder->status != Order::ORDER_STATUS_WAIT_SEND){
			return new Response('订单不是在待发货状态', 0);
		}
		$mOrder->set('status', Order::ORDER_STATUS_WAIT_RECEIVE);
		$mOrder->set('deliver_time', NOW_TIME);
		$mOrder->save();
		//发送系统通知：发货
		$id = SystemSns::insert([
			'user_id' => $mOrder->user_id,
			'type' => SystemSns::TYPE_SEND_GOODS,
			'content' => '',
			'data_id' => $mOrder->id,
			'create_time' => NOW_TIME,
		]);
		$aRecord = SystemSns::getList(['id' => $id]);
		if($aRecord){
			Yii::$app->jpush->sendNotification($aRecord[0]['title'], $aRecord[0]['title'], 8, [$mOrder->user_id], array_merge([
				'user_ids' => [$mOrder->user_id],
			], $aRecord[0]), true);
		}
		return new Response('操作成功', 1);
	}
	
	public function actionShowReturnExchangeList(){
		$oReturnExchangeListForm = new ReturnExchangeListForm();
		$aParams = Yii::$app->request->get();
		if($aParams && (!$oReturnExchangeListForm->load($aParams, '') || !$oReturnExchangeListForm->validate())){
			return new Response(current($oReturnExchangeListForm->getErrors())[0]);
		}
		$aList = $oReturnExchangeListForm->getList();
		$oPage = $oReturnExchangeListForm->getPageObject();
		//检查更新退款记录
		Http::sendNotWaitGetRequest(Yii::$app->urlManagerHome->createUrl(['site/query-refund-money']), ['vender_id' => Yii::$app->vender->id]);
		return $this->render('show-return-exchange-list', [
			'aReturnExchangeList' => $aList,
			'userId' => $oReturnExchangeListForm->userId,
			'orderNumber' => $oReturnExchangeListForm->orderNumber,
			'type' => $oReturnExchangeListForm->type,
			'isHandle' => $oReturnExchangeListForm->isHandle,
			'oPage' => $oPage,
		]);
    }
	
	public function actionSureReturnExchange(){
		$id = (int)Yii::$app->request->post('id');
		$status = (int)Yii::$app->request->post('status');
		$reason = (string)Yii::$app->request->post('reason');
		
		$mReturnExchange = ReturnExchange::findOne($id);
		if(!$mReturnExchange){
			return new Response('找不到退换货信息', 0);
		}
		if($mReturnExchange->vender_id != Yii::$app->vender->id){
			return new Response('非法操作', 0);
		}
		if($mReturnExchange->is_handle){
			return new Response('此记录已处理过了', 0);
		}
		$mOrder = Order::findOne(['order_number' => $mReturnExchange->order_number]);
		if(!$mOrder){
			return new Response('找不到订单信息', 0);
		}
		$msg = '';
		$msgType = 0;
		
		if($mReturnExchange->type == ReturnExchange::TYPE_RETURN_AND_EXCHANGE){
			if($status){
				$msgType = 6;
				$msg = '商家已同意您的退货申请，稍后会与您联系，请保持电话畅通。';
				$mOrder->set('status', Order::ORDER_STATUS_RETURN_GM_SUCCESS);
			}else{
				$msgType = 7;
				$msg = '商家没有同意您的退货申请。详情请查看“我的订单”，如有疑问，可咨询Unique Design官方客服';
				$mOrder->set('status', Order::ORDER_STATUS_RETURN_GM_CLOSE);
			}
		}elseif($mReturnExchange->type == ReturnExchange::TYPE_RETURN_MONEY){
			if($status){
				$msgType = 4;
				$msg = '商家已同意您的退款申请，稍后会与您联系，请保持电话畅通。';
				$mOrder->set('status', Order::ORDER_STATUS_RETURN_MONEY_SUCCESS);
			}else{
				$msgType = 5;
				$msg = '商家没有同意您的退款申请。详情请查看“我的订单”，如有疑问，可咨询Unique Design官方客服';
				$mOrder->set('status', Order::ORDER_STATUS_RETURN_MONEY_CLOSE);
			}
		}elseif($mReturnExchange->type == ReturnExchange::TYPE_RETURN_GOODS){
			if($status){
				$msgType = 2;
				$msg = '商家已同意您的换货申请，稍后会与您联系，请保持电话畅通。';
				$mOrder->set('status', Order::ORDER_STATUS_RETURN_GOODS_SUCCESS);
			}else{
				$msgType = 3;
				$msg = '商家没有同意您的换货申请。详情请查看“我的订单”，如有疑问，可咨询Unique Design官方客服';
				$mOrder->set('status', Order::ORDER_STATUS_RETURN_GOODS_CLOSE);
			}
		}
		$mOrder->save();
		
		$mReturnExchange->set('is_handle', 1);
		$mReturnExchange->set('handle_reason', $reason);
		$mReturnExchange->save();
		//Jpush通知用户
		Yii::$app->jpush->sendNotification($msg, $msg, $msgType, [$mReturnExchange->user_id], [
			'record_id' => $mReturnExchange->id,
			'user_ids' => [$mReturnExchange->user_id],
			'reason' => $reason,
		]);
		
		return new Response('操作成功', 1);
	}
	
	public function actionSureRefundMoney(){
		$id = (int)Yii::$app->request->post('id');
		
		$mReturnExchange = ReturnExchange::findOne($id);
		if(!$mReturnExchange){
			return new Response('找不到退换货信息', 0);
		}
		if($mReturnExchange->vender_id != Yii::$app->vender->id){
			return new Response('非法操作', 0);
		}
		
		$mOrder = Order::findOne(['order_number' => $mReturnExchange->order_number]);
		if(!$mOrder){
			return new Response('找不到订单信息', 0);
		}
		
		$outTradeNo = $mOrder->order_number;
		$refundMoney = $mOrder->pay_money;
		$isSuccess = false;
		if($mOrder->pay_type == Order::PAY_TYPE_ALIPAY){
			$isSuccess = Yii::$app->mobileAlipay->refund($outTradeNo, $refundMoney);
		}elseif($mOrder->pay_type == Order::PAY_TYPE_WEIXIN){
			$isSuccess = Yii::$app->wxpay->refundOrder($outTradeNo, $refundMoney, $refundMoney);
		}
		if($isSuccess){
			$mReturnExchange->set('refund_money', $refundMoney);
			$mReturnExchange->save();
		}else{
			return new Response('申请退款失败', 0);
		}
		return new Response('申请退款成功', 1);
	}
	
}
