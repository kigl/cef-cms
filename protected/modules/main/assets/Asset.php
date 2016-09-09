<?php

namespace app\modules\main\assets;

class Asset extends \yii\web\AssetBundle
{
	public $sourcePath = '@app/modules/main/assets/bundle';

	public $css = ['css/main.css'];

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
	];
}