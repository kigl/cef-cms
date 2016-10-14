<?php

namespace app\components\fontAwesome;

class Asset extends \yii\web\AssetBundle
{
	public $sourcePath = '@app/components/fontAwesome/bundle';
	
	public $css = [
		'css/font-awesome.min.css',
	];
}

?>