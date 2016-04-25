<?php
namespace common\assets;

/**
 * cookie插件资源包
 */
class CookieAsset extends \umeworld\lib\AssetBundle{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
    ];

    public $js = [
		'@r.js.jquery_cookie'
    ];

    public $depends = [

    ];
}