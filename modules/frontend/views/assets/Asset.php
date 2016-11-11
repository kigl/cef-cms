<?php

namespace app\modules\frontend\views\assets;

class Asset extends \yii\web\AssetBundle
{
	public $sourcePath = '@app/modules/frontend/views/assets/bundle';
	
	public $css = ['css/main.css'];
	
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
		'app\core\components\fontAwesome\Asset',
	];
}

?>