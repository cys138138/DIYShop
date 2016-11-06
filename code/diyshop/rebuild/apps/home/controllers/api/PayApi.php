<?php
namespace home\controllers\api;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Url;

trait PayApi{
	
	private function getPrePayParams(){
		$paramStr = Yii::$app->request->post('order_info');
		
		if($paramStr){
			$sign = Yii::$app->mobileAlipay->buildRequestMysign($paramStr);
			
			return new Response('sign', 1, $sign);
		}else{
			$nonceStr = Yii::$app->request->post('nonce_str');
			$outTradeNo = Yii::$app->request->post('out_trade_no');
			$totalFee = Yii::$app->request->post('total_fee');
			$spbillCreateIp = Yii::$app->request->post('spbill_create_ip');
			$tradeType = Yii::$app->request->post('trade_type');
			
			$aSuccess = Yii::$app->wxpay->payUnifiedOrder([
				'body' => '商品支付',
				'outTradeNo' => $outTradeNo,
				'totalFee' => $totalFee,
				'tradeType' => $tradeType,
				'spbillCreateIp' => $spbillCreateIp,
				'nonceStr' => $nonceStr,
				'notifyUrl' => Yii::$app->urlManagerHome->createUrl(['site/weixin-notify']),
			]);
			if(isset($aSuccess['result_code']) && $aSuccess['result_code'] == 'SUCCESS'){
				return new Response('', 1, $aSuccess);
			}
		}
		
		return new Response('请求出错', 0);
	}

}
