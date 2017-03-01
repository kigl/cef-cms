<?php
/**
 * Class Asset
 * @package app\modules\comment\widgets\frontend\comment\views\asset
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\comment\widgets\frontend\comment\views\asset;


use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@app/modules/comment/widgets/frontend/comment/views/asset/bundle';

    public $css = [
        'css/style.css',
    ];
}