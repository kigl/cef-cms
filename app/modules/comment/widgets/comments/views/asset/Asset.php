<?php
/**
 * Class Asset
 * @package app\modules\comment\widgets\frontend\comment\views\asset
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\comment\widgets\comments\views\asset;


use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@app/modules/comment/widgets/comments/views/asset/bundle';

    public $css = [
        'css/style.css',
    ];

    public $js = [
      'js/script.js',
    ];
 }