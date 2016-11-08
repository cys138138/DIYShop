<?php
namespace umeworld\lib;

use Yii;
use umeworld\lib\Wxpay\lib\WxPayApi;
use umeworld\lib\Wxpay\lib\WxPayNotify;
use umeworld\lib\Wxpay\lib\WxPayUnifiedOrder;

class WxPay extends WxPayApi{
	public $sslCertPath = '';
	public $sslKeyPath = '';

	public function payNotifyCallBack(){
		$oWxPayNotify = new PayNotifyCallBack();
		$oWxPayNotify->Handle(false);
		return $oWxPayNotify;
	}

	public function payUnifiedOrder($param){
		$oPayUnifiedOrder = new PayUnifiedOrder();
		$oPayUnifiedOrder->body = $param['body'];
		$oPayUnifiedOrder->outTradeNo = $param['outTradeNo'];
		$oPayUnifiedOrder->totalFee = $param['totalFee'];
		$oPayUnifiedOrder->tradeType = $param['tradeType'];
		$oPayUnifiedOrder->nonceStr = $param['nonceStr'];
		
		return $oPayUnifiedOrder->unifiedOrder();
	}
	
}

class PayNotifyCallBack extends WxPayNotify
{	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		if(is_array($data)){
			foreach($data as $key => $value){
				$this->SetData($key, $value);
			}
		}
		Yii::info("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		
		return true;
	}
}

class PayUnifiedOrder extends WxPayUnifiedOrder
{
	public $body = '';
	public $outTradeNo = '';
	public $totalFee = '';
	public $tradeType = '';
	public $nonceStr = '';
	public $spbillCreateIp = '';
	public $notifyUrl = '';
	
	public function unifiedorder($openId = '', $product_id = '')
	{
		//统一下单
		$input = new WxPayUnifiedOrder();
		$input->SetBody($this->body);
		//$input->SetAttach("test");
		$input->SetOut_trade_no($this->outTradeNo);
		$input->SetTotal_fee($this->totalFee);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		//$input->SetGoods_tag("test");
		$input->SetNotify_url($this->notifyUrl);
		$input->SetTrade_type($this->tradeType);
		$input->SetOpenid($openId);
		$input->SetFee_type('CNY');
		$input->SetProduct_id($product_id);
		$input->SetNonce_str($this->nonceStr);
		$input->SetSpbill_create_ip($this->spbillCreateIp);
		$result = WxPayApi::unifiedOrder($input);
		Yii::info("unifiedorder:" . json_encode($result));
		return $result;
	}
	
	public function NotifyProcess($data, &$msg)
	{
		//echo "处理回调";
		Yii::info("call back:" . json_encode($data));
		
		if(!array_key_exists("openid", $data) ||
			!array_key_exists("product_id", $data))
		{
			$msg = "回调数据异常";
			return false;
		}
		 
		$openid = $data["openid"];
		$product_id = $data["product_id"];
		
		//统一下单
		$result = $this->unifiedorder($openid, $product_id);
		if(!array_key_exists("appid", $result) ||
			 !array_key_exists("mch_id", $result) ||
			 !array_key_exists("prepay_id", $result))
		{
		 	$msg = "统一下单失败";
		 	return false;
		 }
		
		$this->SetData("appid", $result["appid"]);
		$this->SetData("mch_id", $result["mch_id"]);
		//$this->SetData("nonce_str", WxPayApi::getNonceStr());
		$this->SetData("nonce_str", $this->nonceStr);
		$this->SetData("prepay_id", $result["prepay_id"]);
		$this->SetData("result_code", "SUCCESS");
		$this->SetData("err_code_des", "OK");
		return true;
	}
}