<?php

namespace app\core\components\fontAwesome;

class Asset extends \yii\web\AssetBundle
{
	public $sourcePath = '@app/core/components/fontAwesome/bundle';
	
	public $css = [
		'css/font-awesome.min.css',
	];
}

?>