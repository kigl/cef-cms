<?php
/**
 * Class ProducerModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use app\modules\shop\models\backend\Producer;
use app\modules\shop\models\backend\Shop;
use app\modules\shop\Module;

class ProducerModelService extends ProducerGroupModelService
{
    private $_model;

    public function create()
    {
        $shop = Shop::findOne($this->data['get']['shop_id']);

        if (!$shop) {
            throw new HttpException(500);
        }

        $this->_model = new Producer([
            'shop_id' => $shop->id,
            'group_id' => $this->getData('get', 'group_id')
        ]);

        $this->setData([
            'model' => $this->_model,
            'shop' => $shop,
            'shop_id' => $shop->id,
            'breadcrumbs' => $this->getBreadcrumbs($shop),
        ]);

        return $this->save();
    }


    public function update()
    {
        $this->_model = Producer::findOne($this->data['get']['id']);

        if (!$this->_model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $this->_model,
            'shop' => $this->_model->shop,
            'shop_id' => $this->_model->shop_id,
            'breadcrumbs' => $this->getBreadcrumbs($this->_model->shop),
        ]);


        return $this->save();
    }

    private function load()
    {
        return $this->_model->load($this->getData('post'));
    }

    private function save($validate = true)
    {
        if ($this->load()) {
            return $this->_model->save($validate);
        }

        return false;
    }
}