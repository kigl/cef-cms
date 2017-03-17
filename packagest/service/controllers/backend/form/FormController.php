<?php
/**
 * Class FormController
 * @package app\modules\service\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\service\controllers\backend\form;


use Yii;
use kigl\cef\module\service\components\BackendController;
use kigl\cef\core\actions\Delete;
use kigl\cef\core\actions\Create;
use kigl\cef\core\actions\Update;
use kigl\cef\module\service\models\form\Form;
use kigl\cef\module\service\service\form\FormModelService;

class FormController extends BackendController
{
    public function actions()
    {
        return [
            'create' => [
                'class' => Create::class,
                'modelClass' => Form::class,
            ],
            'update' => [
                'class' => Update::class,
                'modelClass' => Form::class,
            ],
            'delete' => [
                'class' => Delete::class,
                'modelClass' => Form::class,
            ],
        ];
    }

    public function actionManager()
    {
        $modelService = Yii::createObject(FormModelService::class);
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }
}