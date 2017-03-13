<?php

namespace app\modules\shop\controllers\backend;


use Yii;
use app\modules\shop\service\backend\GroupModelService;
use app\modules\shop\components\BackendController;

class GroupController extends BackendController
{

    public function actionManager($id = null)
    {
        $modelService = Yii::createObject(GroupModelService::class)
            ->setData([
                'get' => Yii::$app->request->getQueryParams(),
            ]);
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate($parent_id = null)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->actionCreate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['manager', 'id' => $modelService->getData('model')->id]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->actionUpdate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['manager', 'id' => $modelService->getData('model')->parent_id]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = new GroupModelService();
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {

            return $this->redirect(['group/manager', 'id' => $modelService->getData('model')->parent_id]);
        }

        return false;
    }
}