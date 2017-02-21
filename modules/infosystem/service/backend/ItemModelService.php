<?php
/**
 * Class ItemModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\service\backend;

use app\modules\infosystem\models\Item;
use app\core\service\ModelService;

class ItemModelService extends ModelService
{
    public function actionCreate()
    {
        $model = new Item;
        $model->infosystem_id = $this->getData('get', 'infosystem_id');
        $model->group_id = $this->getData('get', 'group_id');

        if ($model->load($this->getData('post')) and $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }

    public function actionUpdate(array $params)
    {
        $model = Item::find()
            ->byId($params['get']['id'])
            ->one();

        if ($model->load($params['post']) and $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Item::findOne($id);

        if ($model->delete()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_DELETE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }
}