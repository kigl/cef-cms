<?php

namespace app\modules\backend\views\assets;

class Asset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/modules/backend/views/assets/bundle';

    public $css = [
        'css/main.css',
        'css/AdminLTE.css',
        'css/_all-skins.css',
    ];

    public $js = [
        'js/app.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'app\core\assets\FontAwesome',
    ];
}