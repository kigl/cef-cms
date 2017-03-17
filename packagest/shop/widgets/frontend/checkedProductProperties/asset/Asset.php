<?php
/**
 * Class Asset
 * @package app\modules\shop\widgets\checkedProductProperties
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\shop\widgets\frontend\checkedProductProperties\asset;


use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@kigl/cef/module/shop/widgets/frontend/checkedProductProperties/asset/bundle';

    public $css = ['css/style.css'];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}