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

class PackingModelService extends ProductModelService
{
    private $_model;

    public function create()
    {
        $product = Product::findOne($this->data['get']['product_id']);

        if (!$product) {
            throw new HttpException(500);
        }

        $this->_model = new Packing([
            'product_id' => $product->id,
        ]);

        $this->setData([
            'model' => $this->_model,
            'product_id' => $product->id,
            'measureList' => $this->getMeasureList(),
            'breadcrumbs' => $this->getBreadcrumbs($product->shop, $product->group_id, $product->id),
        ]);

        return $this->save();
    }

    public function update()
    {
        $this->_model = Packing::findOne($this->data['get']['id']);

        if (!$this->_model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $this->_model,
            'product_id' => $this->_model->product->id,
            'measureList' => $this->getMeasureList(),
            'breadcrumbs' => $this->getBreadcrumbs(
                $this->_model->product->shop,
                $this->_model->product->group_id,
                $this->_model->product->id,
                $this->_model->name),
        ]);

        return $this->save();
    }

    private function load()
    {
        return $this->_model->load($this->getData('post'));
    }

    private function save()
    {
        if ($this->load()) {
            return $this->_model->save();
        }

        return false;
    }
}