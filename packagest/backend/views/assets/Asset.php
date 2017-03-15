<?php

namespace kigl\cef\module\backend\views\assets;

class Asset extends \yii\web\AssetBundle
{
	public $sourcePath = '@kigl/cef/module/backend/views/assets/bundle';

	public $css = [
					'css/main.css',
				];

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
        'kigl\cef\core\assets\FontAwesome',
	];
}