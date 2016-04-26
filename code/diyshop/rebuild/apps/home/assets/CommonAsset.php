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
		'@r.css.morris',
		'@r.css.awesome',
		'@r.css.common',
    ];

    public $js = [
		'@r.js.log',
		'@r.js.bstool',
		'@r.js.global',
		'@r.js.common',
    ];

	public $depends = [
		'common\assets\JQueryAsset',
		'home\assets\CoreAsset',
		'common\assets\BootstrapAsset',
		'common\assets\UBoxAsset',
	];
}
