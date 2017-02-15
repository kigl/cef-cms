<?php
/**
 * Class Asset
 * @package app\modules\shop\widgets\checkedProductProperties
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\widgets\frontend\checkedProductProperties\asset;


use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@app/modules/shop/widgets/frontend/checkedProductProperties/asset/bundle';

    public $css = ['css/style.css'];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}