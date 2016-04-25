<?php
namespace common\assets;

class BootstrapAsset extends \umeworld\lib\AssetBundle{
	public $css = [
		'@r.css.bootstrap',
	];

	public $js = [
		'@r.js.bootstrap',
		'@r.jquery.bootstrap.teninedialog.v3',
	];

	public $depends = [
		'common\assets\JQueryAsset'
	];
}