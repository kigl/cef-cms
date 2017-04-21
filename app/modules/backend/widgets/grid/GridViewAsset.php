<?php
/**
 * Class GridViewAsset
 * @package kigl\cef\module\backend\widgets\grid
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\backend\widgets\grid;


use yii\web\AssetBundle;

class GridViewAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/backend/widgets/grid/assets';

    public $js = [
        'script.js',
    ];
}