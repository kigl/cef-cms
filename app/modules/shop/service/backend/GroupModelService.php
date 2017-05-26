<?php
/**
 * Class GroupModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use Yii;
use yii\data\ArrayDataProvider;
use yii\web\HttpException;
use app\modules\shop\models\backend\Shop;
use app\modules\shop\models\backend\Product;
use app\modules\shop\models\backend\SearchModel;
use app\modules\shop\models\backend\Group;

class GroupModelService extends ModelService
{
    public function manager()
    {
        $search = new SearchModel();

        $shop = Shop::findOne(['id' => $this->getData('get', 'shop_id')]);

        if (!$shop) {
            throw new HttpException(500, 'Not shop model');
        }

        $group = Group::find()
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

        $model = new Group([
            'parent_id' => $this->getData('get', 'parent_id'),
            'shop_id' => $shop->id,
        ]);

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbs($shop, $this->getData('get', 'parent_id')),
        ]);

        if ($model->load($this->getData('post'))) {

            return $model->save();
        }

        return false;
    }

    public function update()
    {
        $model = Group::find()
            ->with('shop')
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        if (!$model || !$model->shop) {
            throw new HttpException(500, 'Not model');
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbs($model->shop, $this->getData('get', 'id')),
        ]);

        if ($model->load($this->getData('post'))) {

            return $model->save();
        }

        return false;
    }

    public function delete($id)
    {
        $model = Group::find()
            ->where([Group::tableName() . '.id' => $id])
            ->with(['products', 'subGroups'])
            ->one();

        if ($model && $model->delete()) {

            foreach ($model->products as $product) {
                Yii::createObject(ProductModelService::class)->actionDelete($product->id);
            }

            // рекурсивно удаляем вложенные группы
            foreach ($model->subGroups as $group) {
                $this->delete($group->id);
            }

            $this->setData([
                'model' => $model,
            ]);

            return true;
        }

        return false;
    }
}
