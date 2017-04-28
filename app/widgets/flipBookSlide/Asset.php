<?php
/**
 * Class Asset
 * @package app\widgets\flipBookSlide
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\widgets\flipBookSlide;


use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@app/widgets/flipBookSlide/assets';

    public $css = [
        'css/flipbook.style.css',
    ];

    public $js = [
        'js/flipbook.min.js'
    ];
}