<?php
namespace home\controllers;

use Yii;
use umeworld\lib\Response;
use umeworld\lib\Xxtea;

class ApiController extends \yii\web\Controller{
	use \home\controllers\api\UserApi;
	use \home\controllers\api\OrderApi;
	use \home\controllers\api\DressApi;
	use \home\controllers\api\ShoppingCartApi;
	use \home\controllers\api\GuessLikeApi;
	use \home\controllers\api\VoteApi;
	use \home\controllers\api\UserDressCollectionApi;
	use \home\controllers\api\AdvertisementApi;
	use \home\controllers\api\ConfigApi;
	use \home\controllers\api\TestApi;
	
	const REGISTER_USER_GIVE_GOLD = 100; //注册新用户送100金币
	
	private $_version = '1.0.0';
	private $_appCode = [
		'android_diyshop' => 'ce854c997d463edcfb54ac4e0732d139',	//app_code => app_key
		'ios_diyshop' => '538982ef3dcdad018e59d2884fd8add1'			//app_code => app_key
	];
	
	public $enableCsrfValidation = false;
	public function actions(){
		return [
			'error' => [
				'class' => 'umeworld\lib\ErrorAction',
			],
		];
	}
	
	/*
		接口Http POST请求权限参数：
		1、version:版本号		string(10) 如：1.0
		2、api_name:接口名称	string(50) 如：getUserInfo
		3、timestamp:时间戳		string(20) 如：2016-05-28 11:04:32
		4、app_code:应用标识	string(20) 如：android_diyshop	ios_diyshop
		5、app_key:应用码(隐)	string(50) 如：Android:ce854c997d463edcfb54ac4e0732d139	IOS:538982ef3dcdad018e59d2884fd8add1
		6、token:数据有效签名	string(50) 如：md5(app_code + timestamp + api_name + app_key)
	*/
	public function actionIndex(){
		$_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $version = Yii::$app->request->post('version');
		$apiName = Yii::$app->request->post('api_name');
		$timeStamp = Yii::$app->request->post('timestamp');
		$appCode = Yii::$app->request->post('app_code');
		$token = Yii::$app->request->post('token');
		
		if(!$version){
			return new Response('缺少版本号', 1000);
		}
		if($version != $this->_version){
			return new Response('版本号错误', 1001);
		}
		if(!$appCode){
			return new Response('缺少应用标识', 1002);
		}
		if(!isset($this->_appCode[$appCode])){
			return new Response('应用标识错误', 1003);
		}
		if(!$timeStamp){
			return new Response('缺少时间戳', 1004);
		}
		if(!preg_match('/\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2}/', $timeStamp)){
			return new Response('时间戳格式错误', 1005);
		}
		if(!$token){
			return new Response('缺少token', 1006);
		}
		if($token != md5($appCode . $timeStamp . $apiName . $this->_appCode[$appCode])){
			return new Response('数据有效签名错误', 1007);
		}
		if(!$apiName){
			return new Response('缺少接口名称', 1008);
		}
		if(!method_exists($this, $apiName)){
			return new Response('接口名称错误', 1009);
		}
		
		$oResponse = $this->$apiName();
		if(Yii::$app->qiniu->enable){
			$oResponse->data = \common\model\QiNiuPicKeyMap::replaceLocalPicToQiniuFileKey($oResponse->data);
		}
		return $oResponse;
	}
		
	private function _getUserToken($id){
		return ['user_token' => Xxtea::encrypt($id . ':' . NOW_TIME)];
	}
	
	private function _getUserIdByUserToken($userToken){
		$str = Xxtea::decrypt($userToken);
		$aData = explode(':', $str);
		if(isset($aData[0]) && $aData[0]){
			return $aData[0];
		}
		return 0;
	}

}
