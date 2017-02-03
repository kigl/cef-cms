<?php

namespace app\modules\shop\controllers\backend;


use Yii;
use app\modules\shop\service\backend\GroupModelService;
use app\modules\shop\service\backend\GroupViewService;
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

        $viewModelService = Yii::createObject(GroupViewService::class)->setData($modelService->getData());

        return $this->render('manager', ['data' => $viewModelService]);
    }

    public function actionCreate($parent_id = null)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->actionCreate([
            'post' => Yii::$app->request->post(),
            'parentId' => $parent_id,
        ]);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['manager', 'id' => $modelService->getData('model')->id]);
        }

        $viewService = (new GroupViewService())->setData($modelService->getData());

        return $this->render('create', ['data' => $viewService]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->actionUpdate([
            'post' => Yii::$app->request->post(),
            'id' => $id,
        ]);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['manager', 'id' => $modelService->getData('model')->parent_id]);
        }

        $viewService = (new GroupViewService())->setData($modelService->getData());

        return $this->render('update', ['data' => $viewService]);
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