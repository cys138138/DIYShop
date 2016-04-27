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
		
		
		'vender-manage/show-list.html'											=> 'vender-manage/show-list',
		'vender-manage/show-edit.html'											=> 'vender-manage/show-edit',
		'vender-manage/save.json'												=> 'vender-manage/save',
		'vender-manage/delete.json'												=> 'vender-manage/delete',
		
		
		'dress-catalog/show-list.html'											=> 'dress-catalog/show-list',
		'dress-catalog/show-edit.html'											=> 'dress-catalog/show-edit',
		'dress-catalog/save.json'												=> 'dress-catalog/save',
		'dress-catalog/delete.json'												=> 'dress-catalog/delete',
		
		
		//跳转页面
		'jump/<jumpType:\w+>.html'						=> 'jump/jump',

		//这条规则如无特殊原因必须放最底下!
		'debug/<controller>/<action>' => 'debug/<controller>/<action>',

	],
];