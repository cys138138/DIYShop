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
		
		
		'login.html'															=> 'login/index',
		'manager/login.html'													=> 'login/manager-login',
		
		
		'manager/index.html'													=> 'manager/index',
		'manager/logout.html'													=> 'manager/logout',
		
		
		'advertisement/show-manage.html'										=> 'advertisement/show-manage-advertisement',
		'advertisement/show-list.html'											=> 'advertisement/show-list',
		'advertisement/show-edit.html'											=> 'advertisement/show-edit',
		'advertisement/save.json'												=> 'advertisement/save',
		'advertisement/delete.json'												=> 'advertisement/delete',
		'advertisement/save-advertisement-catalog-config.json'					=> 'advertisement/save-advertisement-catalog-config',
		'advertisement/upload-file.html'										=> 'advertisement/upload-file',
		
		//跳转页面
		'jump/<jumpType:\w+>.html'						=> 'jump/jump',

		//这条规则如无特殊原因必须放最底下!
		'debug/<controller>/<action>' => 'debug/<controller>/<action>',

	],
];