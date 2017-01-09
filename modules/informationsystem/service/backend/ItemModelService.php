<?php
/**
 * Class ItemModelService
 * @package app\modules\informationsystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\service\backend;

use app\modules\informationsystem\models\Item;
use app\core\service\ModelService;

class ItemModelService extends ModelService
{
    public function actionCreate()
    {
        $model = new Item;
        $model->informationsystem_id = $this->getData('get', 'informationsystem_id');
        $model->group_id = $this->getData('get', 'group_id');

        if ($model->load($this->getData('post')) and $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'informationsystemId' => $model->informationsystem_id,
            'groupId' => $model->group_id,
        ]);
    }

    public function actionUpdate()
    {
        $model = Item::find()
            ->byId($this->getData('get', 'id'))
            ->one();

        if ($model->load($this->getData('post')) and $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'groupId' => $model->group_id,
            'informationsystemId' => $model->informationsystem_id,
        ]);
    }
}