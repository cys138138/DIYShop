<?php
namespace home\controllers;

use Yii;
use home\lib\Controller;
use umeworld\lib\Response;
use umeworld\lib\Url;
use umeworld\lib\Xxtea;
use common\model\Order;
use common\model\Dress;
use common\model\VoteRecord;
use common\model\SystemSns;
use common\model\ReturnExchange;
use yii\helpers\ArrayHelper;

/**
 * 站点控制器
 */
class SiteController extends \yii\web\Controller{
	public $enableCsrfValidation = false;
	public function actions(){
		return [
			'error' => [
				'class' => 'umeworld\lib\ErrorAction',
			],
		];
	}
	
    public function actionIndex(){
		$mManager = Yii::$app->manager->getIdentity();
		if($mManager){
			return Yii::$app->response->redirect(Url::to(['manager/index']));
		}
		$mVender = Yii::$app->vender->getIdentity();
		if($mVender){
			return Yii::$app->response->redirect(Url::to(['vender/index']));
		}
        return $this->render('index');
    }

    public function actionShowHome(){
		/*
		//select
		debug(\common\model\User::findOne(1)->toArray());
		$mUser = \common\model\User::findOne(1);
		//update
		$mUser->set('name', 'jay');
		$mUser->save();
		//insert
		debug(\common\model\User::insert(['name' => 'james']));
		//delete
		$mUser->delete();
		*/
        echo Url::to(['site/show-home']);
    }
	
	/**
	 * 微信支付异步通知
	 */
	public function actionWeixinNotify(){
		$oWxPayNotify = Yii::$app->wxpay->payNotifyCallBack();
		$aReturnData = $oWxPayNotify->GetValues();
		Yii::info(var_export($aReturnData, true));
		if(isset($aReturnData['return_code']) && $aReturnData['return_code'] == 'SUCCESS'){ 
			//支付成功
			$this->_afterPaySuccess(2, $aReturnData['out_trade_no'], $aReturnData['transaction_id']);
		}else{
			//支付失败

		}
	}
	
	/**
	 * 移动端支付宝异步通知
	 */
	public function actionAlipayNotifyMobile(){
		Yii::info(var_export($_POST, true));
		
		$successFlag = 'success';
		$failFlag = 'fail';
		//Yii::$app->mobileAlipay->alipay_config = $this->_getAlipayConfig();
		$verifyResult = Yii::$app->mobileAlipay->verifyNotify();
		//Yii::error('yes, is Notify ' . (int)$verifyResult);
		if($verifyResult){
			//验证成功
			//商户订单号
			//$out_trade_no = $_POST['out_trade_no'];
			$orderId = Yii::$app->request->post('out_trade_no');

			//支付宝交易号
			//$trade_no = $_POST['trade_no'];
			$tradeNo = Yii::$app->request->post('trade_no');

			//交易状态
			//$trade_status = $_POST['trade_status'];
			$orderStatus = Yii::$app->request->post('trade_status');

			if($orderStatus == 'TRADE_SUCCESS'){
				//Yii::error('okokok');
				//exit($successFlag);
				//成功,更新订单状态
				$this->_afterPaySuccess(1, $orderId, $tradeNo);
			}
			exit($successFlag);
		}else{
			Yii::info('验证失败:' . var_export($_POST, true));
			exit($failFlag);
		}
	}
	
	private function _afterPaySuccess($payType, $orderNumber, $tradeNo){
		$mOrder = Order::findOne(['order_number' => $orderNumber]);
		if(!$mOrder){
			Yii::info('找不到订单信息:' . var_export($_POST, true));
			exit($failFlag);
		}
		if($mOrder->status != Order::ORDER_STATUS_WAIT_PAY){
			Yii::info('订单状态不正确:' . var_export($_POST, true));
			exit($failFlag);
		}
		
		$mOrder->set('status', Order::ORDER_STATUS_WAIT_SEND);
		$mOrder->set('pay_type', $payType);
		$mOrder->set('pay_time', NOW_TIME);
		$mOrder->set('trace_num', $tradeNo);
		$mOrder->save();
		//发送系统通知：付款成功
		$id = SystemSns::insert([
			'user_id' => $mOrder->user_id,
			'type' => SystemSns::TYPE_PAY_ORDER,
			'content' => '',
			'data_id' => $mOrder->id,
			'create_time' => NOW_TIME,
		]);
		if($mOrder->order_type == Order::ORDER_TYPE_SPECIAL){
			foreach($mOrder->order_info as $ordernum){
				$mOrder = Order::findOne(['order_number' => $ordernum]);
				if(!$mOrder){
					Yii::info('找不到订单信息:' . var_export($_POST, true));
					exit($failFlag);
				}
				$mOrder->set('status', Order::ORDER_STATUS_WAIT_SEND);
				$mOrder->set('pay_type', $payType);
				$mOrder->set('pay_time', NOW_TIME);
				$mOrder->set('trace_num', $tradeNo);
				$mOrder->save();
				Order::updateDressSaleCount($mOrder->order_info);
			}
		}else{
			Order::updateDressSaleCount($mOrder->order_info);
		}
		$aRecord = SystemSns::getList(['id' => $id]);
		if($aRecord){
			Yii::$app->jpush->sendNotification($aRecord[0]['title'], $aRecord[0]['title'], 8, [$mOrder->user_id], array_merge([
				'user_ids' => [$mOrder->user_id],
			], $aRecord[0]), true);
		}
	}
	
	/**
	 *	处理失效订单，将3日前的订单失效，并调整库存
	 */
	public function actionOrderFailure(){
		$venderId = (int)Yii::$app->request->get('vender_id');
		
		Order::setOrderFailure($venderId);
	}

	/**
	 *	服饰上架的时候看看这个服饰是否有投票用户，有的话jpush个消息给用户
	 */
	public function actionDressOnSaleJpushToUser(){
		$dressIdStr = (string)Yii::$app->request->get('dress_id');
		$dressId = Xxtea::decrypt($dressIdStr);
		$mDress = Dress::findOne($dressId);
		if(!$mDress){
			return;
		}
		$aVoteRecord = VoteRecord::findAll(['identity' => md5($dressId)]);
		$aUserIds = ArrayHelper::getColumn($aVoteRecord, 'user_id');
		if($aUserIds){
			Yii::$app->jpush->sendNotification('亲爱的用户，您有喜欢的服饰上架了', '亲爱的用户，您有喜欢的服饰上架了', 1, $aUserIds, [
				'dress_id' => $mDress->id,
				'user_ids' => $aUserIds,
			]);
		}
		//发送系统通知：您有喜欢的服饰上架了
		$aData = [];
		foreach($aUserIds as $userId){
			$aTemp = [
				'user_id' => $userId,
				'type' => SystemSns::TYPE_LIKE_DRESS_ON_SALES,
				'content' => '',
				'data_id' => $dressId,
				'create_time' => NOW_TIME,
			];
			array_push($aData, $aTemp);
		}
		if($aData){
			SystemSns::batchInsertRecord($aData);
		}
	}

	public function actionQueryRefundMoney(){
		$venderId = Yii::$app->request->get('vender_id');
		
		$aList = ReturnExchange::getVenderRefundingRecordList($venderId);
		foreach($aList as $key => $aValue){
			$mReturnExchange = ReturnExchange::toModel($aValue);
			$mOrder = Order::findOne(['order_number' => $mReturnExchange->order_number]);
			if($mOrder){
				$isSuccess = false;
				if($mOrder->pay_type == Order::PAY_TYPE_WEIXIN){
					$isSuccess = Yii::$app->wxpay->refundMoneyQuery($mReturnExchange->order_number);
				}elseif($mOrder->pay_type == Order::PAY_TYPE_ALIPAY){
					$isSuccess = Yii::$app->mobileAlipay->refundMoneyQuery($mReturnExchange->order_number);
				}
				if($isSuccess){
					$mReturnExchange->set('refund_time', NOW_TIME);
					$mReturnExchange->save();
				}
			}
		}
	}
}
