<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.02.2017
 * Time: 20:20
 */

namespace app\modules\service\service\menu;


use app\core\traits\Breadcrumbs;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\service\models\menu\Item;

class ItemModelService extends ModelService
{
    use Breadcrumbs;

    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find()
                ->where(['parent_id' => $this->getData('get', 'id')])
                ->andWhere(['menu_id' => $this->getData('get', 'menu_id')]),
            'sort' => [
                'defaultOrder' => ['sorting' => SORT_ASC],
            ],
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'menuId' => $this->getData('get', 'menu_id'),
            'id' => $this->getData('get', 'id'),
            'breadcrumbs' => $this->getMenuItemsBreadcrumbs($this->getData('get', 'id')),
        ]);
    }

    public function actionCreate()
    {
        $model = new Item();
        $model->menu_id = $this->getData('get', 'menu_id');
        $model->parent_id = $this->getData('get', 'parent_id');

        if ($this->saveItem($model, $this->getData('post'))) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }

    public function actionUpdate()
    {
        $model = Item::findOne($this->getData('get', 'id'));

        if ($this->saveItem($model, $this->getData('post'))) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }

    protected function saveItem(Model $model, array $params)
    {
        if ($model->load($params) && $model->save()) {
            return true;
        }

        return false;
    }

    public function actionDelete($id)
    {
        $model = Item::find()
            ->with('subItems')
            ->where(['id' => $id])
            ->one();

        if ($model && $model->delete()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_DELETE);

            foreach ($model->subItems as $item) {
                $this->actionDelete($item->id);
            }
        }

        $this->setData([
            'model' => $model,
            'parentId' => $model->parent_id,
        ]);
    }

    protected function getMenuItemsBreadcrumbs($itemId)
    {
        $breadcrumbs = $this->buildBreadcrumbs([
            'items' => [
                'id' => $itemId,
                'modelClass' => Item::class,
                'urlOptions' => [
                    'route' => '/backend/service/menu/item',
                    'params' => ['id',],
                ],
            ],
        ]);

        //array_unshift($breadcrumbs, ['label' => $infosystem->name, 'url' => ['manager', 'infosystem_id' => $infosystem->id]]);

        return $breadcrumbs;
    }
}