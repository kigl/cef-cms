<?php
/**
 * Class InfosystemController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers\backend;


use yii;
use app\modules\infosystem\service\backend\InfosystemModelService;
use app\modules\infosystem\components\BackendController;

class InfosystemController extends BackendController
{
    public function actions()
    {
        return [
            'create' => [
                'class' => 'app\core\actions\Create',
                'modelClass' => '\app\modules\infosystem\models\Infosystem',
                'view' => 'create',
                'redirect' => ['manager'],
            ],
            'update' => [
                'class' => 'app\core\actions\Update',
                'modelClass' => '\app\modules\infosystem\models\Infosystem',
                'view' => 'update',
                'redirect' => ['manager'],
            ],
        ];
    }

    public function actionManager()
    {
        $modelService = Yii::createObject(InfosystemModelService::class);
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = Yii::createObject(InfosystemModelService::class);
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {
            return $this->redirect(['manager']);
        }

        return false;
    }

    public function actionTest($system, $group)
    {
        echo $system . $group;
    }
}