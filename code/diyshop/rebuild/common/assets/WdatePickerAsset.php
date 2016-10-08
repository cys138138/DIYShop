<?php
namespace common\assets;

class WdatePickerAsset extends \umeworld\lib\AssetBundle{
	public $js = [
		'@r.js.wdate-picker'
	];

	public $depends = [
		'common\assets\JQueryAsset',
	];
}