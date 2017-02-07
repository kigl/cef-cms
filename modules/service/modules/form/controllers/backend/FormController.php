<?php
/**
 * Class FormController
 * @package app\modules\service\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\modules\form\controllers\backend;


use Yii;
use app\modules\service\models\Form;
use app\core\actions\Create;
use app\modules\service\components\BackendController;
use app\modules\service\modules\form\service\FormModelService;

class FormController extends BackendController
{
    public function actions()
    {
        return [
            'create' => [
                'class' => Create::class,
                'model' => Form::class,
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