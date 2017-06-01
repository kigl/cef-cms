<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.06.2017
 * Time: 20:57
 */

namespace app\modules\shop\service\backend;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use app\modules\shop\models\backend\Property;
use app\modules\shop\models\backend\Shop;
use app\modules\shop\Module;

class PropertyModelService extends ShopModelService
{
    private $_model;

    public function manager()
    {
        $shop = Shop::findOne($this->getData('get', 'shop_id'));

        if (!$shop) {
            throw new HttpException(500);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Property::find()
                ->where(['shop_id' => $shop->id])
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs($shop),
            'shop_id' => $shop->id,
        ]);
    }

    public function create()
    {
        $shop = Shop::findOne($this->getData('get', 'shop_id'));

        if (!$shop) {
            throw new HttpException(500);
        }

        $this->_model = new Property([
            'shop_id' => $shop->id,
        ]);

        $this->setData([
            'model' => $this->_model,
            'breadcrumbs' => $this->getBreadcrumbs($shop),
        ]);

        return $this->save();
    }

    public function update()
    {
        $this->_model = Property::findOne($this->getData('get', 'id'));

        if (!$this->_model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $this->_model,
            'breadcrumbs' => $this->getBreadcrumbs($this->_model->shop, $this->_model->name),
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

    protected function getBreadcrumbs(Model $shop = null, $data = null)
    {
        $items = parent::getBreadcrumbs($shop, null);

        $items[] = ['label' => Module::t('Product properties'), 'url' => ['manager', 'shop_id' => $shop->id]];

        if ($data) {
            $items[] = ['label' => $data];
        }

        return $items;
    }
}