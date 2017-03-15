<?php

/**
 * User: ARstudio
 * Date: 26.12.2016
 * Time: 11:54
 */

namespace app\modules\shop\views\frontend\asset;

class Asset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/modules/shop/views/frontend/asset/bundle';

    public $js = [
        'js/addToCart.js',
    ];
}