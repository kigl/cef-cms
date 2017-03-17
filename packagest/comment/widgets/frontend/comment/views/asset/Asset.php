<?php
/**
 * Class Asset
 * @package app\modules\comment\widgets\frontend\comment\views\asset
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\comment\widgets\frontend\comment\views\asset;


use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@kigl/cef/module/comment/widgets/frontend/comment/views/asset/bundle';

    public $css = [
        'css/style.css',
    ];

    public $js = [
      'js/script.js',
    ];
 }