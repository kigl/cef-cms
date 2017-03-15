<?php
/**
 * Class FormController
 * @package app\modules\service\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\controllers\backend\form;


use Yii;
use app\modules\service\components\BackendController;
use app\core\actions\Delete;
use app\core\actions\Create;
use app\core\actions\Update;
use app\modules\service\models\form\Form;
use app\modules\service\service\form\FormModelService;

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