<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 10.01.2017
 * Time: 20:53
 */

namespace app\modules\user\controllers\backend;


use Yii;
use yii\helpers\ArrayHelper;
use app\modules\user\components\rbac\RbacService;
use app\modules\user\service\backend\RbacViewService;
use app\modules\user\components\BackendController;
use app\modules\user\service\backend\RbacModelService;

class RbacController extends BackendController
{
    public function actionManager()
    {
        $modelService = Yii::createObject(RbacModelService::class);
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate()
    {
        $modelService = Yii::createObject([
            'class' => RbacModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
            ],
        ]);
        $modelService->actionCreate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['rbac/manager']);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($name, $type)
    {
        $modelService = Yii::createObject([
            'class' => RbacModelService::class,
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);
        $modelService->actionUpdate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['rbac/manager']);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($type, $name)
    {
        $modelService = Yii::createObject(RbacModelService::class);
        $modelService->actionDelete($type, $name);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {
            return $this->redirect(['rbac/manager']);
        }
    }
}