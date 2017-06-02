<?php
/**
 * Class ShopModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use app\modules\shop\models\backend\Producer;
use app\modules\shop\models\backend\ProducerGroup;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\core\traits\Breadcrumbs;
use app\modules\shop\Module;
use app\modules\shop\models\backend\ProductGroup;
use app\modules\shop\models\backend\Product;
use app\modules\shop\models\backend\Shop;
use app\modules\shop\models\backend\Measure;
use app\modules\shop\models\backend\Currency;

class ShopModelService extends \app\core\service\ModelService
{
    private $_model;

    use Breadcrumbs;

    public function manager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Shop::find()
                ->where(['site_id' => Yii::$app->site->getId()]),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);

        return true;
    }

    public function create()
    {
        $this->_model = new Shop();

        $this->setData([
            'model' => $this->_model,
            'measureList' => $this->getMeasureList(),
            'currencyList' => $this->getCurrencyList(),
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);

        return $this->save();
    }

    public function update()
    {
        $this->_model = Shop::findOne($this->getData('get', 'id'));

        $this->setData([
            'model' => $this->_model,
            'measureList' => $this->getMeasureList(),
            'currencyList' => $this->getCurrencyList(),
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);

        return $this->save();
    }

    public function delete($id)
    {
        $this->_model = Shop::findOne($id);

        if ($this->_model->delete()) {
            $products = Product::find()
                ->where(['shop_id' => $this->_model->id])
                ->andWhere(['group_id' => null])
                ->all();

            foreach ($products as $product) {
                Yii::createObject(ProductModelService::className())
                    ->delete($product->id);
            }

            $groups = ProductGroup::find()
                ->where(['shop_id' => $this->_model->id])
                ->andWhere(['parent_id' => null])
                ->all();

            foreach ($groups as $group) {
                Yii::createObject(ProductGroupModelService::className())
                    ->delete($group->id);
            }

            $producers = Producer::find()
                ->where(['shop_id' => $this->_model->id])
                ->andWhere(['group_id' => null])
                ->all();

            foreach ($producers as $producer) {
                $producer->delete();
            }

            $producerGroups = ProducerGroup::find()
                ->where(['shop_id' => $this->_model->id])
                ->andWhere(['parent_id' => null])
                ->all();

            foreach ($producerGroups as $producerGroup) {
                Yii::createObject(ProducerGroupModelService::className())
                    ->delete($producerGroup->id);
            }

            return true;
        }

        return false;
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
        $breadcrumbs = [];

        $breadcrumbs[] = ['label' => Module::t('Shops'), 'url' => ['backend-shop/manager']];

        if ($shop) {
            $breadcrumbs[] = ['label' => $shop->name, 'url' => ['backend-product-group/manager', 'shop_id' => $shop->id]];
        }

        if ($data) {
           $breadcrumbs[] = ['label' => $data];
        }

        return $breadcrumbs;
    }

    protected function getMeasureList()
    {
        $models = Measure::find()
            ->where(['site_id' => Yii::$app->site->getId()])
            ->asArray()
            ->all();

        return ArrayHelper::map($models, 'id', 'name');
    }

    protected function getCurrencyList()
    {
        $models = Currency::find()
            ->where(['site_id' => Yii::$app->site->getId()])
            ->all();

        return ArrayHelper::map($models, 'id', 'short_name');
    }
}