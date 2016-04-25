<?php
namespace home\assets;

Class UeditorAsset extends \umeworld\lib\AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $js = [
		'@r.js.ueditor_config',
		'@r.js.ueditor',
		'@r.js.ueditor_lang_cn',
		'@r.js.ueditor_parse'
	];
	public $css = [
	];
	public $depends = [
	];
}