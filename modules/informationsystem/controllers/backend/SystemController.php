<?php
/**
 * Class SystemController
 * @package app\modules\informationsystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\controllers\backend;


use yii;
use app\modules\informationsystem\service\backend\InformationSystemModelService;
use app\modules\informationsystem\components\BackendController;

class SystemController extends BackendController
{
    public function actions()
    {
        return [
            'create' => [
                'class' => 'app\core\actions\Create',
                'modelClass' => '\app\modules\informationsystem\models\Informationsystem',
                'view' => 'create',
                'redirect' => ['manager'],
            ],
            'update' => [
                'class' => 'app\core\actions\Update',
                'modelClass' => '\app\modules\informationsystem\models\Informationsystem',
                'view' => 'update',
                'redirect' => ['manager'],
            ],
        ];
    }

    public function actionManager()
    {
        $modelService = Yii::createObject(InformationSystemModelService::class);
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = Yii::createObject(InformationSystemModelService::class);
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {
            return $this->redirect(['manager']);
        }

        return false;
    }
}