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

        if ($model->load($this->getData('post')) and $model->save()) {
            $this->setAction(self::ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'informationsystemId' => $this->getData('get', 'informationsystem_id'),
            'parentId' => $this->getData('get', 'parent_id'),
        ]);
    }

    public function actionUpdate()
    {
        $model = Group::findOne($this->getData('get', 'id'));

        if ($model->load($this->getData('post')) and $model->save()) {
            $this->setAction(self::ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'parentId' => $model->parent_id,
            'informationsystemId' => $model->informationsystem_id,
        ]);
    }
}