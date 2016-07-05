<?php

defined('PROJECT_PATH') || define('PROJECT_PATH', __DIR__);
defined('FRAMEWORK_PATH') || define('FRAMEWORK_PATH', PROJECT_PATH . '/framework');

$aLocal = [
	'is_debug' => true,
	'env' => 'prod',
	'domain_prefix' => 'weixin',
	'domain_name' => 'qydxc',
	'domain_suffix' => [
		'dev' => 'dev',
		'test' => 'test',
		'prod' => 'com',
	],
	'db' => [
		'master' => [
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => 'root',
			'node' => [
				['dsn' => 'mysql:host=127.0.0.1;dbname=diyshop'],
			],
		],
		'slaver' => [
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => 'root',
			'node' => [
				['dsn' => 'mysql:host=127.0.0.1;dbname=diyshop'],
			],
		],
	],
	'cache' => [
		'redis' => [
			'host'		=>	'127.0.0.1',
			'port'		=>	'6379',
			'password'	=>	'',
			'server_name' => 'redis_1',
			'part' => [
				'data' => 1,
				'login' => 2,
				'temp' => 3,
			],
		],

		'redisCache' => [
			'host'		=>	'127.0.0.1',
			'port'		=>	'6379',
			'password'	=>	'',
			'server_name' => 'redis_1',
			'part' => 3,
		],
	],
	'temp' => [],
];


/*if(isset($_SERVER['SERVER_ADDR'])){
	if($_SERVER['SERVER_ADDR'] == '192.168.1.202'){
		$aLocal['env'] = 'test';
		$aLocal['cache']['redis']['part']['login'] = 4;
	}elseif($_SERVER['SERVER_ADDR'] == '115.115.25.111'){
		$aLocal['env'] = 'prod';
	}
}*/

if(!class_exists('Yii')){
	defined('YII_DEBUG') || define('YII_DEBUG', $aLocal['is_debug']);
	defined('YII_ENV') || define('YII_ENV', $aLocal['env']);
	require(FRAMEWORK_PATH . '/autoload.php');
	require(FRAMEWORK_PATH . '/yiisoft/yii2/Yii.php');
	require(PROJECT_PATH . '/rebuild/common/config/bootstrap.php');
}