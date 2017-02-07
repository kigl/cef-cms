<?php
/**
 * Class FormFieldModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\modules\form\service;


use app\core\service\ModelService;
use app\modules\service\modules\form\models\Field;

class FieldModelService extends ModelService
{
    public function actionCreate()
    {
        $model = new Field();
        $model->form_id = $this->getData('get', 'form_id');

        if ($model->load($this->getData('post')) && $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }

    public function actionUpdate()
    {
        $model = Field::findOne($this->getData('get', 'id'));

        if ($model->load($this->getData('post')) && $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }
}