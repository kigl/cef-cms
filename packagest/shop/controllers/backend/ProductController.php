<?php

namespace app\modules\shop\controllers\backend;

use Yii;
use app\modules\shop\components\BackendController;
use app\modules\shop\service\backend\ProductModelService;

class ProductController extends BackendController
{
    public function actionCreate($group_id = null, $parent_id = null)
    {
        $modelService = Yii::createObject([
            'class' => ProductModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);
        $modelService->actionCreate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['product/update', 'id' => $modelService->getData('model')->id]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject([
            'class' => ProductModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);

        $modelService->actionUpdate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['product/update', 'id' => $modelService->getData('model')->id]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
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
