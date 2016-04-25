<?php
namespace common\assets;

class StandAlonePageAsset extends \umeworld\lib\AssetBundle{
	public $js = [
		'@r.js.core',
		'@r.js.stand-alone-page',
	];

    public $depends = [
		'common\assets\JQueryAsset',
    ];

	public $jsOptions = [
		'position' => \yii\web\View::POS_HEAD,
	];
}