<?php
/**
 * Class FormFieldModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\service\service\form;


use yii\data\ActiveDataProvider;
use kigl\cef\core\service\ModelService;
use kigl\cef\core\traits\Breadcrumbs;
use kigl\cef\module\service\Module;
use kigl\cef\module\service\models\form\Form;
use kigl\cef\module\service\models\form\Field;

class FieldModelService extends ModelService
{
    use Breadcrumbs;

    public function actionManager()
    {
        $query = Field::find()
            ->where(['form_id' => $this->getData('get', 'form_id')]);
        $form = Form::findOne($this->getData('get', 'form_id'));

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getItemsBreadcrumb($form),
        ]);
    }

    public function actionCreate()
    {
        $model = new Field();
        $model->form_id = $this->getData('get', 'form_id');
        $form = Form::findOne($this->getData('get', 'form_id'));

        if ($model->load($this->getData('post')) && $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumb($form),
        ]);
    }

    public function actionUpdate()
    {
        $model = Field::find()
            ->with('form')
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        if ($model->load($this->getData('post')) && $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumb($model->form),
        ]);
    }

    protected function getItemsBreadcrumb(Form $form)
    {
        $breadcrumbs[] = ['label' => Module::t('Forms'), 'url' => ['form/form/manager']];
        $breadcrumbs[] = ['label' => $form->name];
        $breadcrumbs[] = ['label' => Module::t('Form fields'), 'url' => ['form/field/manager', 'form_id' => $form->id]];

        return $breadcrumbs;
    }
}