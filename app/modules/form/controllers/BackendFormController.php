<?php
/**
 * Class FormController
 * @package app\modules\service\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\form\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\backend\actions\Delete;
use app\modules\backend\actions\Create;
use app\modules\backend\actions\Update;
use app\modules\form\models\backend\Form;
use app\modules\form\models\backend\service\FormModelService;

class BackendFormController extends Controller
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