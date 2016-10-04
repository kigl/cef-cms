<?php

namespace app\modules\main\views\assets;

class Asset extends \yii\web\AssetBundle
{
	public $sourcePath = '@app/modules/main/views/assets/bundle';
	
	public $css = ['css/main.css'];
	
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
		'app\modules\main\components\fontAwesome\Asset',
	];
}

?>