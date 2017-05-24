<?php
/**
 * Class FormCompletedModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\forms\service\backend;


use yii\data\ActiveDataProvider;
use app\modules\forms\models\backend\Completed;
use app\modules\forms\models\backend\Form;

class CompletedModelService extends ModelService
{
    public function actionManager()
    {
        $form = Form::findOne($this->getData('get', 'form_id'));
        $dataProvider = new ActiveDataProvider([
            'query' => Completed::find()
                ->where(['form_id' => $form->id]),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getItemsBreadcrumb($form),
        ]);
    }

    public function actionView()
    {
        $model = Completed::find()
            ->where(['id' => $this->getData('get', 'id')])
            ->with(['fieldsValue.field.group', 'form'])
            ->one();

        $fieldsGroup = [];
        foreach ($model->fieldsValue as $key => $fieldValue) {
            if ($fieldValue->field->group) {
                $fieldsGroup[$fieldValue->field->group->sorting][$fieldValue->field->group->name][$fieldValue->field->sorting][$key] = $fieldValue->value;
            } else {
                $fieldsGroup[$fieldValue->field->sorting]['none'][$fieldValue->field->sorting][$key] = $fieldValue->value;
            }
        }

        ksort($fieldsGroup);

        $this->setData([
            'model' => $model,
            'fieldsGroup' => $fieldsGroup,
            'breadcrumbs' => $this->getItemsBreadcrumb($model->form, null,
                \Yii::$app->formatter->asDateTime($model->create_time)),
        ]);
    }
}