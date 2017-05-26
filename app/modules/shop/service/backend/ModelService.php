<?php
/**
 * Class ModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use yii\base\Model;
use yii\helpers\Html;
use app\modules\shop\Module;
use app\core\traits\Breadcrumbs;
use app\modules\shop\models\backend\Group;
use app\modules\shop\models\backend\Product;

class ModelService extends \app\core\service\ModelService
{
    use Breadcrumbs;

    protected function getBreadcrumbs(Model $shop = null, $groupId = null, $name = null, $productId = null)
    {
        $items = $this->buildBreadcrumbs([
            'items' => [
                'id' => $groupId,
                'modelClass' => Group::class,
                //'enableRoot' => true,
                'urlOptions' => [
                    'route' => 'backend-group/manager',
                    'params' => ['id', 'shop_id'],
                ],
            ],
        ]);

        $product = $this->buildBreadcrumbs([
            'items' => [
                'id' => $productId,
                'modelClass' => Product::class,
                //'enableRoot' => true,
                'urlOptions' => [
                    'route' => 'backend-product/update',
                    'params' => ['id',],
                ],
            ],
        ]);

        $items = array_merge_recursive($items, $product);

        if ($shop) {
            array_unshift($items,
                ['label' => Html::encode($shop->name), 'url' => ['backend-group/manager', 'shop_id' => $shop->id]]);
        }

        array_unshift($items, ['label' => Module::t('Shops'), 'url' => ['backend-shop/manager']]);

        if ($name) {
            array_push($items, ['label' => $name]);
        }

        return $items;
    }
}