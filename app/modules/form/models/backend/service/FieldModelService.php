<?php
/**
 * Class FormFieldModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\form\models\backend\service;


use app\modules\form\models\backend\Form;
use app\modules\form\models\backend\Field;

class FieldModelService extends ModelService
{
    public function actionCreate()
    {
        $formId = $this->getData('get', 'form_id');
        $groupId = $this->getData('get', 'group_id');

        $model = new Field([
            'form_id' => $formId,
            'group_id' => $groupId,
        ]);
        $form = Form::findOne($formId);

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumb($form, $groupId),
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {
            return true;
        }

        return false;
    }

    public function actionUpdate()
    {
        $model = Field::find()
            ->with('form')
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumb($model->form, $model->group_id, $model->name),
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {
            return true;
        }

        return false;
    }
}