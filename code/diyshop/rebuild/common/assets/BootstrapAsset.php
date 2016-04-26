<?php
namespace common\assets;

class BootstrapAsset extends \umeworld\lib\AssetBundle{
	public $css = [
		'@r.css.bootstrap',
		'@r.css.sb.admin',
	];

	public $js = [
		'@r.js.bootstrap',
		'@r.js.bootstrap.min',
		'@r.jquery.bootstrap.teninedialog.v3',
	];

	public $depends = [
		'common\assets\JQueryAsset'
	];
}