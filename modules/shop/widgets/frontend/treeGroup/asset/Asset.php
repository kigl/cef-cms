<?php
/**
 * Class Asset
 * @package app\modules\shop\widgtes\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\widgets\frontend\treeGroup\asset;



use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@app/modules/shop/widgets/frontend/treeGroup/asset/bundle';

    public $css = [
        'css/treeGroup.css',
    ];
}