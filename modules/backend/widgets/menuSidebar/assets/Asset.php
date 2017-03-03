<?php

namespace app\modules\backend\widgets\menuSidebar\assets;

class Asset extends \yii\web\AssetBundle
{
	public $sourcePath = '@app/modules/backend/widgets/menuSidebar/assets/bundle';

	public $css = [
		'css/main.css',
	];

	public $js = [
        'js/jQuery.tree.js',
    ];
}