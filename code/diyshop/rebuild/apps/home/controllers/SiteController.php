<?php
namespace home\controllers;

use Yii;
use home\lib\Controller;
use umeworld\lib\Response;
use umeworld\lib\Url;
use common\model\Order;

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
		Yii::info(var_export($_POST, true));
		$oWxPayNotify = Yii::$app->wxpay->payNotifyCallBack();
		Yii::info(var_export($oWxPayNotify->aResult, true));
		if(isset($oWxPayNotify->aResult['return_code']) && $oWxPayNotify->aResult['return_code'] == 'SUCCESS'){ 
			//支付成功
			$this->_afterPaySuccess($oWxPayNotify->aResult['out_trade_no']);
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
				$this->_afterPaySuccess($orderId);
			}
			exit($successFlag);
		}else{
			Yii::info('验证失败:' . var_export($_POST, true));
			exit($failFlag);
		}
	}
	
	private function _afterPaySuccess($orderNumber){
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
		$mOrder->set('pay_time', NOW_TIME);
		$mOrder->save();
		if($mOrder->order_type == Order::ORDER_TYPE_SPECIAL){
			foreach($mOrder->order_info as $ordernum){
				$mOrder = Order::findOne(['order_number' => $ordernum]);
				if(!$mOrder){
					Yii::info('找不到订单信息:' . var_export($_POST, true));
					exit($failFlag);
				}
				$mOrder->set('status', Order::ORDER_STATUS_WAIT_SEND);
				$mOrder->set('pay_time', NOW_TIME);
				$mOrder->save();
			}
		}
	}
	
	/**
	 *	处理失效订单，将3日前的订单失效，并调整库存
	 */
	public function actionOrderFailure(){$this->_alipay('2b5ed7f95637a95e4e6a0bc638790b82', 0.01);exit;
		$venderId = (int)Yii::$app->request->get('vender_id');
		
		Order::setOrderFailure($venderId);
	}

}
