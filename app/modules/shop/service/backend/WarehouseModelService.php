<?php
/**
 * Class WarehouseModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use yii\data\ActiveDataProvider;
use yii\base\Model;
use yii\web\HttpException;
use app\modules\shop\models\Shop;
use app\modules\shop\Module;
use app\modules\shop\models\backend\Warehouse;

class WarehouseModelService extends ShopModelService
{
    public function manager()
    {
        $shop = Shop::findOne($this->data['get']['shop_id']);

        if (!$shop) {
            throw new HttpException(500);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Warehouse::find()
                ->where(['shop_id' => $shop->id]),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'shop_id' => $shop->id,
            'breadcrumbs' => $this->getBreadcrumbs($shop),
        ]);
    }

    public function create()
    {
        $shop = Shop::findOne($this->data['get']['shop_id']);

        if (!$shop) {
            throw new HttpException(500);
        }

        $model = new Warehouse([
            'shop_id' => $shop->id,
        ]);

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbs($shop),
            'shop_id' => $shop->id,
        ]);

        if ($model->load($this->getData('post'))) {
            return $model->save();
        }

        return false;
    }

    public function update()
    {
        $model = Warehouse::find()
            ->where(['id' => $this->data['get']['id']])
            ->one();

        if (!$this->_model || !$this->_model->shop) {
            throw new HttpException(500, 'No model');
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbs($model->shop, $model->name),
            'shop_id' => $model->shop->id
        ]);

        if ($model->load($this->getData('post'))) {
            return $model->shop;
        }

        return false;
    }

    protected function getBreadcrumbs(Model $shop = null, $data = null)
    {
        $breadcrumbs = parent::getBreadcrumbs($shop, null);

        $breadcrumbs[] = ['label' => Module::t('Warehouses'), 'url' => ['manager', 'shop_id' => $shop->id]];

        if ($data) {
            $breadcrumbs[] = ['label' => $data];
        }

        return $breadcrumbs;
    }
}