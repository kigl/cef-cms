<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.02.2017
 * Time: 20:20
 */

namespace app\modules\service\modules\menu\service;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\service\modules\menu\models\Item;

class ItemModelService extends ModelService
{
    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find()
                ->where(['parent_id' => $this->getData('get', 'parent_id')])
                ->andWhere(['menu_id' => $this->getData('get', 'menu_id')]),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'menuId' => $this->getData('get', 'menu_id'),
            'parentId' => $this->getData('get', 'parent_id'),
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
}