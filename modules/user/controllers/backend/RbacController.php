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

        return $this->render('manager', [
            'roleDataProvider' => $modelService->getData('roleDataProvider'),
            'permissionDataProvider' => $modelService->getData('permissionDataProvider'),
        ]);
    }

    public function actionCreate($type)
    {
        $modelService = Yii::createObject(RbacModelService::class);
        $modelService->actionCreate([
            'post' => Yii::$app->request->post(),
            'type' => $type,
        ]);

        $viewService = (new RbacViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['rbac/manager']);
        }

        return $this->render('create', ['data' => $viewService]);
    }

    public function actionUpdate($name)
    {
        $modelService = Yii::createObject(RbacModelService::class);
        $modelService->actionUpdate([
            'post' => Yii::$app->request->post(),
            'name' => $name,
        ]);

        $viewService = (new RbacViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['rbac/manager']);
        }

        return $this->render('update', ['data' => $viewService]);
    }

    public function actionDelete($name)
    {
        $rbacService = Yii::createObject(RbacService::class);
        $item = $rbacService->getItem($name);

        if ($rbacService->remove($item)) {
            return $this->redirect(['rbac/manager']);
        }
    }
}