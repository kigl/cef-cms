<?php

namespace kigl\cef\module\backend\widgets\menuSidebar\assets;

class Asset extends \yii\web\AssetBundle
{
	public $sourcePath = '@kigl/cef/module/backend/widgets/menuSidebar/assets/bundle';

	public $css = [
		'css/main.css',
	];

	public $js = [
        'js/jQuery.tree.js',
    ];
}