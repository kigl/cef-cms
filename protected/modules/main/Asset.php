<?php

namespace app\modules\main;

class Asset extends \yii\web\AssetBundle
{
	public $basePath = '@webroot';
	public $baseUtl = '@web';

	public $css = ['/protected/modules/main/views/backend/css/main.css'];

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
	];
}