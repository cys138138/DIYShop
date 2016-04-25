<?php
namespace home\assets;

/**
 * 公共资源包,一般每个页面都要注册
 */
class CommonAsset extends \umeworld\lib\AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
	
    ];

    public $js = [
		'@r.js.log',
		'@r.js.bstool',
		'@r.js.global',
    ];

	public $depends = [
		'common\assets\JQueryAsset',
		'home\assets\CoreAsset',
		'common\assets\BootstrapAsset',
		'common\assets\UBoxAsset',
	];
}
