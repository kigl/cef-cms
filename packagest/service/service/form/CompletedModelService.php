<?php
/**
 * Class FormCompletedModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\service\service\form;


use yii\data\ActiveDataProvider;
use kigl\cef\core\service\ModelService;
use kigl\cef\module\service\Module;
use kigl\cef\module\service\models\form\Completed;
use kigl\cef\module\service\models\form\Form;

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

    protected function getItemsBreadcrumb(Form $form)
    {
        $breadcrumbs[] = ['label' => Module::t('Forms'), 'url' => ['form/form/manager']];
        $breadcrumbs[] = ['label' => $form->name, 'url' => ['form/completed/manager', 'form_id' => $form->id]];

        return $breadcrumbs;
    }
}