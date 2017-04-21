<?php
/**
 * Class FormCompletedModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\form\models\backend\service;


use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\form\Module;
use app\modules\form\models\backend\Completed;
use app\modules\form\models\backend\Form;

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
            ->with(['fieldsValue.field', 'form'])
            ->one();

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumb($model->form, \Yii::$app->formatter->asDateTime($model->create_time)),
        ]);
    }

    protected function getItemsBreadcrumb($form, $dateTime = null)
    {
        return [
            ['label' => Module::t('Forms'), 'url' => ['backend-form/manager']],
            ['label' => $form->name, 'url' => ['backend-completed/manager', 'form_id' => $form->id]],
            ['label' => $dateTime],
        ];
    }
}