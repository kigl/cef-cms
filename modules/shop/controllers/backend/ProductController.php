<?php

namespace app\modules\shop\controllers\backend;

use Yii;
use app\modules\shop\components\BackendController;
use app\modules\shop\service\backend\ProductModelService;
use app\modules\shop\service\backend\ProductViewService;

class ProductController extends BackendController
{
    public function actionCreate($group_id)
    {
        $modelService = new ProductModelService();
        $modelService->setData([
                'post' => Yii::$app->request->post(),
                'groupId' => $group_id,
            ]
        );
        $modelService->actionCreate();

        $viewService = (new ProductViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['product/update', 'id' => $modelService->getData('model')->id]);
        }

        return $this->render('create', ['data' => $viewService]);
    }

    public function actionUpdate($id)
    {
        $modelService = new ProductModelService();
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'id' => $id,
        ]);
        $modelService->actionUpdate();

        $viewService = (new ProductViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['product/update', 'id' => $modelService->getData('model')->id]);
        }

        return $this->render('update', ['data' => $viewService]);
    }

    public function actionDelete($id)
    {
        $modelService = new ProductModelService();

        if ($modelService->actionDelete($id)) {

            return $this->redirect(['group/manager', 'parent_id' => $modelService->getData('groupId')]);
        }

        return false;
    }
}
