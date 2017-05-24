<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.02.2017
 * Time: 20:20
 */

namespace app\modules\menu\service\backend;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\menu\Module;
use app\core\traits\Breadcrumbs;
use app\modules\menu\models\backend\Menu;
use app\modules\menu\models\backend\Item;

class ItemModelService extends ModelService
{
    use Breadcrumbs;

    public function manager()
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

    public function create()
    {
        $model = new Item();
        $model->menu_id = $this->getData('get', 'menu_id');
        $model->parent_id = $this->getData('get', 'parent_id');

        $menu = Menu::findOne($model->menu_id);

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumbs($menu, $model->parent_id),
        ]);

        if ($this->saveItem($model, $this->getData('post'))) {

            return true;
        }

        return false;
    }

    public function update()
    {
        $model = Item::find()
            ->with('menu')
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumbs($model->menu, $model->parent_id),
        ]);

        if ($this->saveItem($model, $this->getData('post'))) {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $model = Item::find()
            ->with('subItems')
            ->where(['id' => $id])
            ->one();

        $this->setData([
            'model' => $model,
            'parentId' => $model->parent_id,
        ]);

        if ($model && $model->delete()) {

            foreach ($model->subItems as $item) {
                $this->delete($item->id);
            }

            return true;
        }

        return false;
    }

    protected function saveItem(Model $model, array $params)
    {
        if ($model->load($params) && $model->save()) {
            return true;
        }

        return false;
    }

    protected function getItemsBreadcrumbs($menu, $itemId)
    {
        $breadcrumbs[] = ['label' => Module::t('Menu'), 'url' => ['backend-menu/manager']];
        $breadcrumbs[] = ['label' => $menu->name, 'url' => ['manager', 'menu_id' => $menu->id]];

        $items = $this->buildBreadcrumbs([
            'items' => [
                'id' => $itemId,
                'modelClass' => Item::class,
                'urlOptions' => [
                    'route' => 'backend-item/manager',
                    'params' => ['id', 'menu_id'],
                ],
            ],
        ]);

        return array_merge($breadcrumbs, $items);
    }
}