<?php
/**
 * Class Asset
 * @package app\templates\defaults\assets
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\templates\black\assets;


use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'app\core\assets\FontAwesome',
    ];
}