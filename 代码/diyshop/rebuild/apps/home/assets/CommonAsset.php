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
		'@r.css.sprite',
		'@r.css.global',
    ];

    public $js = [
		'@r.js.log',
		'@r.js.ui1',
		'@r.js.bstool',
		'@r.js.global',
    ];

	public $depends = [
		'common\assets\JQueryAsset',
		'home\assets\CoreAsset',
	];
}
