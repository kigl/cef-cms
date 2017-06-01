<?php
/**
 * Class GroupModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\web\HttpException;
use app\modules\shop\models\backend\Shop;
use app\modules\shop\models\backend\Product;
use app\modules\shop\models\backend\SearchModel;
use app\modules\shop\models\backend\ProductGroup;

class ProductGroupModelService extends ShopModelService
{
    private $_model;

    public function manager()
    {
        $search = new SearchModel();

        $shop = Shop::findOne(['id' => $this->getData('get', 'shop_id')]);

        if (!$shop) {
            throw new HttpException(500, 'Not shop model');
        }

        $group = ProductGroup::find()
            ->where(['parent_id' => $this->getData('get', 'id')])
            ->andWhere(['shop_id' => $shop->id])
            ->asArray();

        $product = Product::find()
            ->where(['group_id' => $this->getData('get', 'id')])
            ->andWhere('parent_id IS NULL')
            ->andWhere(['shop_id' => $shop->id])
            ->asArray();

        if ($search->load($this->getData('get')) && $search->validate()) {
            $group->filterWhere(['like', 'name', $search->name]);
            $group->andFilterWhere(['id' => $search->id]);
            $group->andFilterWhere(["date(create_time)" => $search->create_time]);
            $product->filterWhere(['like', 'name', $search->name]);
            $product->andFilterWhere(['id' => $search->id]);
            $product->andFilterWhere(["date(create_time)" => $search->create_time]);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => array_merge($group->all(), $product->all()),
            'sort' => [
                'attributes' => ['name', 'price', 'active', 'create_time', 'id'],
            ],
        ]);

        $this->setData([
            'id' => $this->getData('get', 'id'),
            'shop_id' => $shop->id,
            'searchModel' => $search,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs($shop, $this->getData('get', 'id')),
        ]);

        return true;
    }

    public function create()
    {
        $shop = Shop::findOne(['id' => $this->getData('get', 'shop_id')]);

        if (!$shop) {
            throw new HttpException(500, 'Not shop model');
        }

        $this->_model = new ProductGroup([
            'parent_id' => $this->getData('get', 'parent_id'),
            'shop_id' => $shop->id,
        ]);

        $this->setData([
            'model' => $this->_model,
            'shop_id' => $shop->id,
            'breadcrumbs' => $this->getBreadcrumbs($shop, $this->getData('get', 'parent_id')),
        ]);

        return $this->save();
    }

    public function update()
    {
        $this->_model = ProductGroup::find()
            ->with('shop')
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        if (!$this->_model || !$this->_model->shop) {
            throw new HttpException(500, 'Not model');
        }

        $this->setData([
            'model' => $this->_model,
            'shop_id' => $this->_model->shop->id,
            'breadcrumbs' => $this->getBreadcrumbs($this->_model->shop, $this->getData('get', 'id'), $this->_model->name),
        ]);

        return $this->save();
    }

    public function delete($id)
    {
        $this->_model = ProductGroup::find()
            ->where([ProductGroup::tableName() . '.id' => $id])
            ->with(['products', 'subGroups'])
            ->one();

        if ($this->_model && $this->_model->delete()) {

            foreach ($this->_model->products as $product) {
                Yii::createObject(ProductModelService::class)
                    ->delete($product->id);
            }

            // рекурсивно удаляем вложенные группы
            foreach ($this->_model->subGroups as $group) {
                $this->delete($group->id);
            }

            $this->setData([
                'model' => $this->_model,
            ]);

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

    protected function getBreadcrumbs(Model $shop = null, $groupId = null, $data = null)
    {
        $breadcrumbs = parent::getBreadcrumbs($shop, null);

        $groups = $this->buildBreadcrumbs([
            'items' => [
                'id' => $groupId,
                'modelClass' => ProductGroup::class,
                //'enableRoot' => true,
                'urlOptions' => [
                    'route' => 'backend-product-group/manager',
                    'params' => ['id', 'shop_id'],
                ],
            ],
        ]);

        if ($groups) {
            $breadcrumbs = array_merge($breadcrumbs, $groups);
        }

        if ($data) {
            $breadcrumbs[] = ['label' => $data];
        }

        return $breadcrumbs;
    }
}
