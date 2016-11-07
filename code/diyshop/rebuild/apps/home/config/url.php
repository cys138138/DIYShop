<?php
/**
 * URL配置控制
 * class : 解析器
 * enablePrettyUrl : 是否开启伪静态
 * showScriptName : 生成的URL是否带入口脚本名称
 * enableStrictParsing : 是否开启严格匹配
 * baseUrl 域名
 */
return [
	'class' => 'yii\web\UrlManager',
	'enablePrettyUrl' => true,
	'showScriptName' => false,
	'enableStrictParsing' => true,
	'baseUrl' => Yii::getAlias('@url.home'),
	'rules' => [
		''																		=> 'site/index',
		'home.html'																=> 'site/show-home',
		'alipay/notify.html'													=> 'site/alipay-notify-mobile',
		'weixin/notify.html'													=> 'site/weixin-notify',
		'site/order-failure.html'												=> 'site/order-failure',
		'site/alipay-test.html'													=> 'site/alipay-test',
		
		
		'index.html'															=> 'login/index',
		'manager/login.html'													=> 'login/show-manager-login',
		'manager/login.json'													=> 'login/manager-login',
		'vender/login.html'														=> 'login/show-vender-login',
		'vender/login.json'														=> 'login/vender-login',
		
		
		'manager/index.html'													=> 'manager/index',
		'manager/logout.html'													=> 'manager/logout',
		
		'vender/index.html'														=> 'vender/index',
		'vender/logout.html'													=> 'vender/logout',
		
		
		'advertisement/show-manage.html'										=> 'advertisement/show-manage-advertisement',
		'advertisement/show-list.html'											=> 'advertisement/show-list',
		'advertisement/show-edit.html'											=> 'advertisement/show-edit',
		'advertisement/save.json'												=> 'advertisement/save',
		'advertisement/delete.json'												=> 'advertisement/delete',
		'advertisement/save-advertisement-catalog-config.json'					=> 'advertisement/save-advertisement-catalog-config',
		'advertisement/upload-file.html'										=> 'advertisement/upload-file',
		
		'bg-advertisement/show-manage-bg-adv.html'								=> 'bg-advertisement/show-manage-bg-adv',
		'bg-advertisement/save-advertisement-config.json'						=> 'bg-advertisement/save-advertisement-config',
		'bg-advertisement/upload-file.html'										=> 'bg-advertisement/upload-file',
		
		'top-advertisement/show-manage-top-adv.html'							=> 'top-advertisement/show-manage-top-adv',
		'top-advertisement/save-advertisement-config.json'						=> 'top-advertisement/save-advertisement-config',
		'top-advertisement/upload-file.html'									=> 'top-advertisement/upload-file',
		
	
		'guess-like/show-list.html'												=> 'guess-like/show-list',
		'guess-like/show-setting.html'											=> 'guess-like/show-setting',
		'guess-like/search-dress.json'											=> 'guess-like/search-dress',
		'guess-like/save-setting.json'											=> 'guess-like/save-setting',
		'guess-like/delete-setting.json'										=> 'guess-like/delete',
		
		
		'discount-activity/show-list.html'										=> 'discount-activity/show-list',
		'discount-activity/show-setting.html'									=> 'discount-activity/show-setting',
		'discount-activity/save-setting.json'									=> 'discount-activity/save-setting',
		'discount-activity/delete-setting.json'									=> 'discount-activity/delete',
		'discount-activity/upload-file.html'									=> 'discount-activity/upload-file',
		
		
		'vote/show-list.html'													=> 'vote/show-list',
		'vote/show-setting.html'												=> 'vote/show-setting',
		'vote/save-setting.json'												=> 'vote/save-setting',
		'vote/delete-setting.json'												=> 'vote/delete',
		'vote/upload-file.html'													=> 'vote/upload-file',
		
		
		
		'order-manage/show-list.html'											=> 'order-manage/show-list',
		'order-manage/save-express-info.json'									=> 'order-manage/save-express-info',
		'order-manage/sure-send-goods.json'										=> 'order-manage/sure-send-goods',
		
		
		
		'user-manage/show-list.html'											=> 'user-manage/show-list',
		'user-manage/add-gold.json'												=> 'user-manage/add-gold',
		'user-manage/delete.json'												=> 'user-manage/delete',
		
		
		'vender-manage/show-list.html'											=> 'vender-manage/show-list',
		'vender-manage/show-edit.html'											=> 'vender-manage/show-edit',
		'vender-manage/save.json'												=> 'vender-manage/save',
		'vender-manage/delete.json'												=> 'vender-manage/delete',
		
		'vender-shop/show-setting.html'											=> 'vender-shop/show-setting',
		'vender-shop/upload-file.html'											=> 'vender-shop/upload-file',
		'vender-shop/save-setting.json'											=> 'vender-shop/save-setting',
		
		
		'dress-catalog/show-list.html'											=> 'dress-catalog/show-list',
		'dress-catalog/show-edit.html'											=> 'dress-catalog/show-edit',
		'dress-catalog/save.json'												=> 'dress-catalog/save',
		'dress-catalog/delete.json'												=> 'dress-catalog/delete',
		
		
		'dress-manage/show-list.html'											=> 'dress-manage/show-list',
		'dress-manage/show-edit.html'											=> 'dress-manage/show-edit',
		'dress-manage/save.json'												=> 'dress-manage/save',
		'dress-manage/delete.json'												=> 'dress-manage/delete',
		'dress-manage/upload-file.html'											=> 'dress-manage/upload-file',
		
		
		'manager-dress-match/show-list.html'									=> 'manager-dress-match/show-list',
		'manager-dress-match/show-edit.html'									=> 'manager-dress-match/show-edit',
		'manager-dress-match/save.json'											=> 'manager-dress-match/save',
		'manager-dress-match/delete.json'										=> 'manager-dress-match/delete',
		'manager-dress-match/upload-file.html'									=> 'manager-dress-match/upload-file',
		
		
		'vender-dress-match/show-list.html'										=> 'vender-dress-match/show-list',
		'vender-dress-match/show-edit.html'										=> 'vender-dress-match/show-edit',
		'vender-dress-match/save.json'											=> 'vender-dress-match/save',
		'vender-dress-match/delete.json'										=> 'vender-dress-match/delete',
		'vender-dress-match/get-manager-dress-match-list.json'					=> 'vender-dress-match/get-manager-dress-match-list',
		'vender-dress-match/upload-file.html'									=> 'vender-dress-match/upload-file',
		
		
		'manager-dress-material/show-list.html'									=> 'manager-dress-material/show-list',
		'manager-dress-material/show-edit.html'									=> 'manager-dress-material/show-edit',
		'manager-dress-material/save.json'										=> 'manager-dress-material/save',
		'manager-dress-material/delete.json'									=> 'manager-dress-material/delete',
		
		
		'manager-dress-decoration/show-list.html'								=> 'manager-dress-decoration/show-list',
		'manager-dress-decoration/show-edit.html'								=> 'manager-dress-decoration/show-edit',
		'manager-dress-decoration/save.json'									=> 'manager-dress-decoration/save',
		'manager-dress-decoration/delete.json'									=> 'manager-dress-decoration/delete',
		'manager-dress-decoration/upload-file.html'								=> 'manager-dress-decoration/upload-file',
		
		
		
		'api/test.html'															=> 'api/test',
		'api.json'																=> 'api/index',
		
		
		//跳转页面
		'jump/<jumpType:\w+>.html'						=> 'jump/jump',

		//这条规则如无特殊原因必须放最底下!
		'debug/<controller>/<action>' => 'debug/<controller>/<action>',

	],
];