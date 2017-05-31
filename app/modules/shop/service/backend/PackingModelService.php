<?php
/**
 * Class PackingModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use yii\web\HttpException;
use app\modules\shop\models\backend\Packing;
use app\modules\shop\models\backend\Product;

class PackingModelService extends GroupModelService
{
    public function create()
    {
        $product = Product::findOne($this->data['get']['product_id']);

        if (!$product) {
            throw new HttpException(500);
        }

        $model = new Packing([
            'product_id' => $product->id,
        ]);

        $this->setData([
            'model' => $model,
            'product_id' => $product->id,
            'listMeasure' => $this->getListMeasure(),
            'breadcrumbs' => $this->getBreadcrumbs($product->shop, $product->group_id),
        ]);

        if ($model->load($this->data['post'])) {
            return $model->save();
        }

        return false;
    }

    public function update()
    {
        $model = Packing::findOne($this->data['get']['id']);

        if (!$model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $model,
            'product_id' => $model->product->id,
            'listMeasure' => $this->getListMeasure(),
            'breadcrumbs' => $this->getBreadcrumbs($model->product->shop, $model->name),
        ]);

        if ($model->load($this->data['post'])) {
            return $model->save();
        }

        return false;
    }
}