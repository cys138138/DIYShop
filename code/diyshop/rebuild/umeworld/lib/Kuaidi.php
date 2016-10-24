<?php
namespace umeworld\lib;

use Yii;

class Kuaidi extends \yii\base\Component {
	public $url;
	public $authKey;
	
	public function getTypeList(){
		return [
			'yuantong' => '圆通速递',
			'ems' => 'EMS',
			'shentong' => '申通',
			'shunfeng' => '顺丰',
			'zhongtong' => '中通速递',
			'zhaijisong' => '宅急送',
			'youzhengguonei' => '邮政包裹（国内）',
			'youzhengguoji' => '邮政小包（国际）',
			'yunda' => '韵达快运',
			'huitongkuaidi' => '百世汇通',
			'tiantian' => '天天快递',
			'quanfengkuaidi' => '全峰快递',
			'rufengda' => '凡客如风达',
		];
	}

	public function query($type, $postid){
		$aResult = json_decode($this->_doHttpResponseGet($this->url, [
			'type' => $type,
			'postid' => $postid,
			'id' => $this->authKey,
			'valicode' => '',
			'temp' => NOW_TIME,
		]), true);
		
		if(!$aResult){
			$aResult = [
				'status' => 404,
				'message' => '网络请求出错，请重新再试！',
			];
		}
		return $aResult;
	}
	
	/**
	 * 发送Http get请求
	 * @param string $url
	 * @param string $para
	 * @return string $responseText
	 */
	private function _doHttpResponseGet($url, $para){
		$curl = curl_init($url . '?' . http_build_query($para));
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);	// SSL证书认证
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);	// 严格认证
		curl_setopt($curl, CURLOPT_HEADER, 0 ); 	// 过滤HTTP头
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);	// 显示输出结果
		$responseText = curl_exec($curl);
		curl_close($curl);

		return $responseText;
	}
}
