<?php
/**
 * Class GroupModelService
 * @package app\modules\informationsystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\service\backend;


use app\core\service\ModelService;
use app\modules\informationsystem\models\Group;

class GroupModelService extends ModelService
{
    public function actionCreate()
    {
        $model = new Group;
        $model->parent_id = $this->getData('get', 'parent_id');
        $model->informationsystem_id = $this->getData('get', 'informationsystem_id');

        if ($model->load($this->getData('post')) and $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'informationsystemId' => $model->informationsystem_id,
        ]);
    }

    public function actionUpdate()
    {
        $model = Group::find()
            ->byId($this->getData('get', 'id'))
            ->one();

        if ($model->load($this->getData('post')) and $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'informationsystemId' => $model->informationsystem_id,
        ]);
    }
}