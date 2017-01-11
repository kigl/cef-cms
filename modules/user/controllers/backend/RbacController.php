<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 10.01.2017
 * Time: 20:53
 */

namespace app\modules\user\controllers\backend;


use app\modules\user\components\rbac\RbacService;
use app\modules\user\service\backend\RbacViewService;
use Yii;
use app\modules\user\components\BackendController;
use app\modules\user\service\backend\RbacModelService;

class RbacController extends BackendController
{
    public function actionManager()
    {
        $modelService = new RbacModelService();
        $modelService->actionManager();

        return $this->render('manager', [
            'roleDataProvider' => $modelService->getData('roleDataProvider'),
            'permissionDataProvider' => $modelService->getData('permissionDataProvider'),
        ]);
    }

    public function actionCreate($type)
    {
        $modelService = new RbacModelService();
        $modelService->actionCreate([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        $viewService = (new RbacViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['rbac/manager']);
        }

        return $this->render('create', ['data' => $viewService]);
    }

    public function actionUpdate($name = '')
    {/*
        $modelService = new RbacModelService();
        $modelService->actionUpdate([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        $viewService = (new RbacViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['rbac/manager']);
        }

        return $this->render('update', ['data' => $viewService]);
*/
        $rbacService = Yii::createObject(RbacService::class);

        $newItem = $rbacService->createItem('loop', 1);

        $rbacService->update('test', $newItem);

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