<?php

namespace app\views\assets;

class Asset extends \yii\web\AssetBundle
{
	public $sourcePath = '@app/views/assets/bundle';
	
	public $css = ['css/main.css'];
	
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
		'app\components\fontAwesome\Asset',
	];
}

?>