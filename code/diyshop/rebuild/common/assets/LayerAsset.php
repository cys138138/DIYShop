<?php
namespace common\assets;

/**
 * layer插件资源包
 */
class LayerAsset extends \umeworld\lib\AssetBundle
{

    public $css = [
    ];

    public $js = [
		'@r.js.layer',
    ];

	public $depends = [
		'common\assets\JQueryAsset'
	];
}
