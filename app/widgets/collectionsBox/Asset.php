<?php
/**
 * Class Asset
 * @package app\widgets\collectionBox
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\widgets\collectionsBox;


use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@app/widgets/collectionsBox/assets';

    public $css = [
        'css/style.css',
    ];
}