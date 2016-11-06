<?php
namespace umeworld\lib;

use Yii;
use umeworld\lib\Wxpay\lib\WxPayApi;
use umeworld\lib\Wxpay\lib\WxPayNotify;

class WxPay extends WxPayApi{
	public $appId = '';
	public $mchId = '';
	public $appKey = '';
	public $appSecret = '';
	public $sslCertPath = '';
	public $sslKeyPath = '';

	public function payNotifyCallBack(){
		$oWxPayNotify = new PayNotifyCallBack();
		$oWxPayNotify->Handle(false);
		return $oWxPayNotify;
	}

	
}

class PayNotifyCallBack extends WxPayNotify
{	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Yii::info("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		return true;
	}
}