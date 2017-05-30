<?php
/**
 * Class PriceModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use app\modules\shop\Module;
use app\modules\shop\models\backend\Price;
use app\modules\shop\models\backend\Shop;

class PriceModelService extends ShopModelService
{
    public function manager()
    {
        $shop = Shop::findOne($this->getData('get', 'shop_id'));

        if (!$shop) {
            throw new HttpException(500);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Price::find()
                ->where(['shop_id' => $shop->id])
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs($shop),
        ]);
    }

    public function create()
    {
        $shop = Shop::findOne($this->getData('get', 'shop_id'));

        if (!$shop) {
            throw new HttpException(500);
        }

        $model = new Price([
            'shop_id' => $shop->id,
        ]);

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbs($shop),
        ]);

        if ($model->load($this->getData('post'))) {
            return $model->save();
        }

        return false;
    }

    public function update()
    {
        $model = Price::findOne($this->getData('get', 'id'));

        if (!$model || !$model->shop) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbs($model->shop, $model->name),
        ]);

        if ($model->load($this->getData('post'))) {
            return $model->save();
        }

        return false;
    }

    public function getBreadcrumbs(Model $shop = null, $data = null)
    {
        $breadcrumbs = parent::getBreadcrumbs($shop);

        $breadcrumbs[] = ['label' => Module::t('Prices'), 'url' => ['manager', 'shop_id' => $shop->id]];

        if ($data) {
            $breadcrumbs[] = ['label' => $data];
        }

        return $breadcrumbs;
    }
}