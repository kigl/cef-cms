<?php

namespace app\modules\main\components\fontAwesome;

class Asset extends \yii\web\AssetBundle
{
	public $sourcePath = '@app/modules/main/components/fontAwesome/bundle';
	
	public $css = [
		'css/font-awesome.min.css',
	];
}

?>