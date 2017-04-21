<?php
/**
 * Class FormFieldModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\form\models\backend\service;


use app\modules\form\models\Field;
use yii\data\ActiveDataProvider;
use app\modules\form\models\backend\Form;
use app\modules\form\models\backend\Group;

class GroupModelService extends Service
{
    public function actionManager()
    {
        $formId = $this->getData('get', 'form_id');
        $groupId = $this->getData('get', 'id');

        $dataProviderGroup = new ActiveDataProvider([
            'query' => Group::find()
                ->where(['form_id' => $formId])
                ->andWhere(['parent_id' => $groupId])
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => Field::find()
                ->where(['form_id' => $formId])
                ->andWhere(['group_id' => $groupId])
        ]);

        $form = Form::findOne($formId);

        $this->setData([
            'dataProviderGroup' => $dataProviderGroup,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getItemsBreadcrumb($form, $groupId),
        ]);
    }

    public function actionCreate()
    {
        $formId = $this->getData('get', 'form_id');
        $parentId = $this->getData('get', 'parent_id');

        $model = new Group([
            'form_id' => $formId,
            'parent_id' => $parentId
        ]);

        $form = Form::findOne($formId);

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumb($form, $parentId),
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {
            return true;
        }

        return false;
    }

    public function actionUpdate()
    {
        $groupId = $this->getData('get', 'id');

        $model = Group::find()
            ->with('form')
            ->where(['id' => $groupId])
            ->one();

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumb($model->form, $groupId),
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {
            return true;
        }

        return false;
    }
}