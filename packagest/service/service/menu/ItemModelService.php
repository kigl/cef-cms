<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.02.2017
 * Time: 20:20
 */

namespace kigl\cef\module\service\service\menu;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use kigl\cef\module\service\Module;
use kigl\cef\core\traits\Breadcrumbs;
use kigl\cef\module\service\models\menu\Menu;
use kigl\cef\core\service\ModelService;
use kigl\cef\module\service\models\menu\Item;

class ItemModelService extends ModelService
{
    use Breadcrumbs;

    public function actionManager()
    {
        $menu = Menu::findOne($this->getData('get', 'menu_id'));
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find()
                ->where(['parent_id' => $this->getData('get', 'id')])
                ->andWhere(['menu_id' => $menu->id]),
            'sort' => [
                'defaultOrder' => ['sorting' => SORT_ASC],
            ],
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'menuId' => $menu->id,
            'id' => $this->getData('get', 'id'),
            'breadcrumbs' => $this->getItemsBreadcrumbs($menu, $this->getData('get', 'id')),
        ]);
    }

    public function actionCreate()
    {
        $model = new Item();
        $model->menu_id = $this->getData('get', 'menu_id');
        $model->parent_id = $this->getData('get', 'parent_id');

        $menu = Menu::findOne($model->menu_id);

        if ($this->saveItem($model, $this->getData('post'))) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumbs($menu, $model->parent_id),
        ]);
    }

    public function actionUpdate()
    {
        $model = Item::find()
            ->with('menu')
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        if ($this->saveItem($model, $this->getData('post'))) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumbs($model->menu, $model->parent_id),
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

    protected function getItemsBreadcrumbs(Menu $menu, $itemId)
    {
        $breadcrumbs[] = ['label' => Module::t('Menu'), 'url' => ['menu/menu/manager']];
        $breadcrumbs[] = ['label' => $menu->name, 'url' => ['manager', 'menu_id' => $menu->id]];

        $items = $this->buildBreadcrumbs([
            'items' => [
                'id' => $itemId,
                'modelClass' => Item::class,
                'urlOptions' => [
                    'route' => '/backend/service/menu/item/manager',
                    'params' => ['id', 'menu_id'],
                ],
            ],
        ]);

        $breadcrumbs = array_merge($breadcrumbs, $items);

        return $breadcrumbs;
    }
}