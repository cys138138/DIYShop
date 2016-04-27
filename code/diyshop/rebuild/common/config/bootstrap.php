<?php
error_reporting(-1);
$appPath = PROJECT_PATH . '/rebuild';
Yii::setAlias('common', dirname(__DIR__));

//APP别名设置 start
if(!YII_ENV_PROD){
	Yii::setAlias('dev', $appPath . '/apps/dev');
}
$domainSuffix = $aLocal['domain_suffix'][YII_ENV];
$domainPrefix = $aLocal['domain_prefix'];
$domainName = $aLocal['domain_name'];

Yii::setAlias('home',				$appPath . '/apps/home');
Yii::setAlias('url.home',			'http://' . $domainPrefix . '.' . $domainName . '.' . $domainSuffix);

//APP别名设置 end

Yii::setAlias('umeworld',			$appPath . '/umeworld');
Yii::setAlias('r.url', 'http://' . $domainPrefix . '.' . $domainName . '.' . $domainSuffix);
Yii::setAlias('p.resource',		$appPath . '/apps/home/web');
Yii::setAlias('p.temp_upload',		'/static/data/temp_upload');
Yii::setAlias('p.advertisement_position_img',	'/static/data/advertisement_position_img');
Yii::setAlias('p.system_view',		$appPath . '/common/views/system');
Yii::setAlias('Endroid', Yii::getAlias('@umeworld') . '/lib');	//二维码扩展
Yii::setAlias('@p.alipay', Yii::getAlias('@umeworld') . '/lib/Alipay');	//支付宝扩展

defined('NOW_TIME') || define('NOW_TIME', time());
unset($appPath, $domainSuffix);

if(!defined('UMFUN_TESTING')){
	/**
	 * 调试输出函数
	 * @param type mixed $xData 要调试输出的数据
	 * @param type int $mode 11=输出并停止运行,111=停止并输出运行轨迹,12=以PHP代码方式输出,13=dump方式输出,其中第十位数为0的时候表示不停止运行,前面的参数样例十位都是1所以会停止运行,个位用于控制输出模式 @see \umeworld\lib\Debug
	 */
	function debug($xData, $mode = null){
		if($mode === null){
			$mode = \umeworld\lib\Debug::MODE_NORMAL;
		}
		\umeworld\lib\Debug::dump($xData, $mode, true);
	}
}

if(isset($_GET['__SQS'])){
	unset($_GET['__SQS']);
}
