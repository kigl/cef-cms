<?php
/**
 * Class ProducerGroupModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\web\HttpException;
use app\modules\shop\models\backend\Producer;
use app\modules\shop\models\backend\ProducerGroup;
use app\modules\shop\models\backend\Shop;
use app\modules\shop\Module;

class ProducerGroupModelService extends ShopModelService
{
    private $_model;

    public function manager()
    {
        $shop = Shop::findOne($this->getData('get', 'shop_id'));

        if (!$shop) {
            throw new HttpException(500);
        }

        $groups = ProducerGroup::find()
            ->where(['shop_id' => $shop->id])
            ->andWhere(['parent_id' => $this->getData('get', 'id')])
            ->asArray()
            ->all();

        $producers = Producer::find()
            ->where(['shop_id' => $shop->id])
            ->andWhere(['group_id' => $this->getData('get', 'id')])
            ->asArray()
            ->all();

        $dataProvider = new ArrayDataProvider([
            'allModels' => array_merge($groups, $producers),
            'sort' => [
                'attributes' => ['name', 'sorting', 'id'],
            ],
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs($shop, $this->getData('get', 'id')),
            'shop_id' => $shop->id,
            'id' => $this->getData('get', 'id'),
        ]);
    }

    public function create()
    {
        $shop = Shop::findOne($this->getData('get', 'shop_id'));

        if (!$shop) {
            throw new HttpException(500);
        }

        $this->_model = new ProducerGroup([
            'shop_id' => $shop->id,
            'parent_id' => $this->getData('get', 'parent_id')
        ]);

        $this->setData([
            'model' => $this->_model,
            'breadcrumbs' => $this->getBreadcrumbs($shop, $this->_model->parent_id),
        ]);

        return $this->save();
    }

    public function update()
    {
        $this->_model = ProducerGroup::findOne($this->getData('get', 'id'));

        if (!$this->_model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $this->_model,
            'breadcrumbs' => $this->getBreadcrumbs($this->_model->shop, $this->_model->id, $this->_model->name),
        ]);

        return $this->save();
    }

    public function delete($id)
    {
        /**
         * @todo
         */
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

    public function getBreadcrumbs(Model $shop = null, $groupId = null, $data = null)
    {
        $items = parent::getBreadcrumbs($shop, null);

        $items[] = [
            'label' => Module::t('Producers'),
            'url' => ['backend-producer-group/manager', 'shop_id' => $shop->id]
        ];

        $groups = $this->buildBreadcrumbs([
            'items' => [
                'id' => $groupId,
                'modelClass' => ProducerGroup::class,
                'urlOptions' => [
                    'route' => 'backend-producer-group/manager',
                    'params' => ['id', 'shop_id'],
                ],
            ],
        ]);

        $items = array_merge($items, $groups);

        if ($data) {
            $items[] = ['label' => $data];
        }

        return $items;
    }
}