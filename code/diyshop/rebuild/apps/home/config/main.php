<?php
$params = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../../common/config/params.php'),
    require(__DIR__ . '/../../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
    //require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'home',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'home\controllers',
    'runtimePath' => PROJECT_PATH . '/runtime/home',
    'components' => [
		/*'ui' => [
			'class' => 'home\lib\Ui1',
			'aTips' => require(__DIR__ . '/tips.php'),
			'advertisement' => require(__DIR__ . '/ui.php'),
		],*/
		'view' => [
			'commonTitle' => 'DiyShop',
			'baseTitle' => 'DiyShop',
			'on beginBody' => function(){
				echo Yii::$app->view->renderFile('@home/views/common/page-init.php');
			},
		],
    ],
	'urlManagerName' => 'urlManagerHome',
	
    'params' => $params,
];
