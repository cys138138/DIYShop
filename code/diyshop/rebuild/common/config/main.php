<?php
return [
    'vendorPath' => FRAMEWORK_PATH,
    'domain' => $aLocal['domain_name'] . '.' . $aLocal['domain_suffix'][YII_ENV],
    'aWebAppList' => [
		'home'
	],
    'language' => 'zh-CN',
    'bootstrap' => ['log'],
	'defaultRoute' => 'site/index',
//	'catchAll' => [
//        'remind/close-website-remind',
//		'words' => '',
//		'start_time' => 0,
//		'end_time' => 0,
//    ],
    'components' => [
		//各APP的URL管理器 start
		'urlManagerHome' => require(Yii::getAlias('@home') . '/config/url.php'),
		//各APP的URL管理器 end

        'request' => [
            'cookieValidationKey' => 'EArv76QW-Dc8ngUP-qndrD0BDlodbqw-',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'smtp.mail.xxx.com',
				'username' => 'service@mail.xxx.com',
				'password' => '5wfylhFxybwDUA5Zi31LQ8Ux',
				'port' => '25',
			],
			'messageConfig' => [
               'charset' => 'UTF-8',
               'from' => ['service@mail.xxx.com' => 'xxx']
            ],
			'htmlLayout' => '@common/views/mail/html-layout',
			'textLayout' => '@common/views/mail/text-layout',
        ],
		'sms'=>[
			'class' => 'umeworld\lib\Sms',
			'username' => 'uniquedesign',
			'password' => '804e0ff8c2bdd2f06bec',
		],

		'jpush'=>[
			'class' => 'umeworld\lib\Jpush',
			'appKey' => '863ff5e5eecfa228c1cc625c',
			'masterSecret' => 'f728efd3424a124159ca4eb7',
		],

		'qiniu'=>[
			'class' => 'umeworld\lib\Qiniu',
			'enable' => true,
			'accessKey' => 'ah3l5zpkx-o5aRN-LM_8ECO12NR9QUlok8jG0wF0',
			'secretKey' => '57_oYNdalSMqLuD_WcLrMS3tCWokkOpvHeC7tjYc',
			'bucket' => 'design-app-images',
			'privateDomain' => 'static.xdh-syy.com',
		],

		'kuaidi'=>[
			'class' => 'umeworld\lib\Kuaidi',
			'url' => 'http://www.kuaidi100.com/query',	//http://api.kuaidi100.com/api
			'authKey' => '1',							//c635d73c707557a5
		],

		'assetManager' => [
			'bundles' => [
				'yii\web\JqueryAsset' => [
					'sourcePath' => null,
					'js' => []
				],
			]
		],

		'response' => [
			'class' => 'yii\web\Response',
			'format' => 'html',
		],

		'notifytion' => [
			'class' => 'common\lib\Notifytion',
		],

        'log' => require(__DIR__ . '/log.php'),

		'errorHandler' => [
			'class' => 'common\lib\ErrorHandler',
			'errorAction' => 'site/error',	//所有站点APP统一使用site控制器的error方法处理网络可能有点慢
		],

		'view' => [
			'class' => 'umeworld\lib\View',
			'on beginPage' => function(){
				Yii::$app->view->title = \yii\helpers\Html::encode(Yii::$app->view->title);

				Yii::$app->view->registerLinkTag([
					'rel' => 'shortcut icon',
					'href' => Yii::getAlias('@r.url') . '/favicon.ico',
				]);

				Yii::$app->view->registerMetaTag([
					'name' => 'csrf-token',
					'content' => Yii::$app->request->csrfToken,
				]);
			},

			'on endPage' => function(){
				// echo '<!--umfun';	//防止尾部运营商注入广告脚本,IE会显示半截标签，暂时屏蔽
			},
		],

        /*'loginManager' => [
            //'class' => 'umeworld\lib\Redis',
            'class' => 'yii\caching\FileCache',
        ],*/

        'user' => [
			//用户控制组件
			'class' => 'common\role\User',
            'identityClass' => 'common\model\User',
            'reloginOvertime' => 1800,
            'rememberLoginTime' => 3000000,
            'enableAutoLogin' => false,
            'loginUrl' => ['login/index'],
        ],
		
        'manager' => [
			//用户控制组件
			'class' => 'common\role\Manager',
            'identityClass' => 'common\model\Manager',
            'reloginOvertime' => 1800,
            'rememberLoginTime' => 3000000,
            'enableAutoLogin' => false,
            'loginUrl' => ['login/show-manager-login'],
        ],
		
        'vender' => [
			//用户控制组件
			'class' => 'common\role\Vender',
            'identityClass' => 'common\model\Vender',
            'reloginOvertime' => 1800,
            'rememberLoginTime' => 3000000,
            'enableAutoLogin' => false,
            'loginUrl' => ['login/show-vender-login'],
        ],
		
		'authManager' => [
			'class' => 'common\role\AuthManager',
			//'aPermissionList' => include(__DIR__ . '/permission.php'),
		],

       'db' => [
            'class' => 'umeworld\lib\Connection',
            'charset' => 'utf8',
			'aTables' => [
				/**
				 * 当你要求user表不使用缓存
				 * 'user' => 'cache:0'
				 *
				 * 当你的某个表不在主库project,而是在财务库xxx_recharge
				 * 'recharge' => 'table:xxx_recharge.recharge'		//以recharge为别名指向具体的数据库,必须有table:
				 *
				 * 既定义数据库的具体位置又定义是否缓存
				 * 'recharge' => 'table:db2.recharge;cache:0'	//这里增加了cache控制,1/0表示是否缓存数据,其实语法就像CSS一样
				 *
				 * 以后若有更多控制需求,可以增加"CSS属性"并在 umeworld\lib\Query::from 类里做解析代码
				 */
				'account_number'	=>	'cache:0',
			],

			'masterConfig' => [
				'username' => $aLocal['db']['master']['username'],
				'password' => $aLocal['db']['master']['password'],
				'attributes' => [
					// use a smaller connection timeout
					PDO::ATTR_TIMEOUT => 10,
					PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
				],
			],

			'masters' => $aLocal['db']['master']['node'],

			'slaveConfig' => [
				'username' => $aLocal['db']['slaver']['username'],
				'password' => $aLocal['db']['master']['password'],
				'attributes' => [
					// use a smaller connection timeout
					PDO::ATTR_TIMEOUT => 10,
					PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
				],
			],

			'slaves' => $aLocal['db']['slaver']['node'],
		],
		
		
		//umeworld\lib\DbCommand public $isOpen = false;
		//umeworld\lib\Query public $isCacheData = false;public $isSelectFromCache = false;
        'redis' => [
            'class' => 'umeworld\lib\RedisCache',
            'isOpen' => false,
			'serverName' => $aLocal['cache']['redis']['server_name'],
			'dataPart'	=>	[
				'index'		=>	$aLocal['cache']['redis']['part']['data'],
				'is_active'	=>	1,
			],
			'loginPart' =>	[
				'index'		=>	$aLocal['cache']['redis']['part']['login'],
				'is_active'	=>	1,
			],
			'tempPart'	=>	[
				'index'		=>	$aLocal['cache']['redis']['part']['temp'],
				'is_active'	=>	1,
			],
			'servers' => [
				'redis_1' => [
					'is_active' => 1,
					'host'		=>	$aLocal['cache']['redis']['host'],
					'port'		=>	$aLocal['cache']['redis']['port'],
					'password'	=>	$aLocal['cache']['redis']['password'],
				],
			],
		],

        'redisCache' => [
            'class' => 'umeworld\lib\RedisCache',
            'isOpen' => false,
			'serverName' => $aLocal['cache']['redisCache']['server_name'],
			'dataPart'	=>	[
				'index'		=>	$aLocal['cache']['redisCache']['part'],
				'is_active'	=>	1,
			],
			'servers' => [
				'redis_1' => [
					'is_active' => 1,
					'host'		=>	$aLocal['cache']['redisCache']['host'],
					'port'		=>	$aLocal['cache']['redisCache']['port'],
					'password'	=>	$aLocal['cache']['redisCache']['password'],
				],
			],
		],

		'client' => [
			'class' => 'umeworld\helper\Client'
		],


		'weiXin' => [
			'class' => 'umeworld\lib\WeiXin',
			'appId' => 'wxd9d3a5c7cd043db9',
			'appSecret' => 'a316496f3a38c7062fafc700b9cfdd32',
		],
		'wxpay' => [
			'class' => 'umeworld\lib\WxPay',
			'sslCertPath' => Yii::getAlias('@umeworld') . '/lib/Wxpay/cert/apiclient_cert.pem',
			'sslKeyPath' => Yii::getAlias('@umeworld') . '/lib/Wxpay/cert/apiclient_key.pem',
		],
		//pc版支付宝即时到账
		'alipay' => [
			'class' => 'umeworld\lib\Alipay\Alipay',
			'partner_id' => '2088521148380255',
			'key' => 'u4kvc5qxf1ma3vze8p5fijkfobqcxudg',
			'cacert_pem' => Yii::getAlias('@p.alipay') . '/support/cacert.pem',
			'alipay_gateway_new' => 'https://mapi.alipay.com/gateway.do?',
			'https_verify_url' => 'https://mapi.alipay.com/gateway.do?service=notify_verify&',
			'http_verify_url' => 'http://notify.alipay.com/trade/notify_query.do?',
		],
		//手机版支付宝即时到账
		'mobileAlipay' => [
			'class' => 'umeworld\lib\MobileAlipay\AlipaySubmit',
			'partner_id' => '2088521148380255',
			'key' => 'u4kvc5qxf1ma3vze8p5fijkfobqcxudg',
			'private_key_path' => Yii::getAlias('@umeworld') . '/lib/MobileAlipay/key/rsa_private_key.pem',
			'ali_public_key_path' => Yii::getAlias('@umeworld') . '/lib/MobileAlipay/key/rsa_public_key.pem',
			'cacert_pem' => Yii::getAlias('@umeworld') . '/lib/MobileAlipay/key/cacert.pem',
			'alipay_gateway_new' => 'https://mapi.alipay.com/gateway.do?',//http://wappaygw.alipay.com/service/rest.htm?',
			'https_verify_url' => 'https://mapi.alipay.com/gateway.do?service=notify_verify&',
			'http_verify_url' => 'http://notify.alipay.com/trade/notify_query.do?',
		],
    ],
];
