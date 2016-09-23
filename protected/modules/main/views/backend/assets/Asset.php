<?php

namespace app\modules\main\views\backend\assets;

class Asset extends \yii\web\AssetBundle
{
	public $sourcePath = '@app/modules/main/views/backend/assets/bundle';

	public $css = [
					'css/main.css',
					'css/font-awesome.min.css'
				];

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
	];
}