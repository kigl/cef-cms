<?php

namespace app\modules\shop\controllers\backend;

use Yii;
use app\modules\shop\components\BackendController;
use app\modules\shop\service\backend\ProductModelService;
use app\modules\shop\service\backend\ProductViewService;

class ProductController extends BackendController
{
    protected $image;
    protected $property;
    protected $relation;

    public function actionCreate($group_id)
    {
        $modelService = new ProductModelService();
        $modelService->setData([
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        );
        $modelService->actionCreate();

        $viewService = (new ProductViewService())->setData($modelService->getData());

        if ($modelService->hasAction($modelService::ACTION_SAVE)) {

            return $this->redirect(['product/update', 'id' => $modelService->getData('model')->id]);
        }

        return $this->render('create', ['data' => $viewService]);
    }

    public function actionUpdate($id)
    {
        $modelService = new ProductModelService();
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->actionUpdate();

        $viewService = (new ProductViewService())->setData($modelService->getData());

        if ($modelService->hasAction($modelService::ACTION_SAVE)) {

            return $this->redirect(['product/update', 'id' => $modelService->getData('model')->id]);
        }

        return $this->render('update', [
            'data' => $viewService,
        ]);

        return $this->render('update', ['data' => $viewService]);
    }

    public function actionDelete($id)
    {
        $modelService = new ProductModelService();
        $modelService->setRequestData(['get' => Yii::$app->request->getQueryParams()]);

        if ($modelService->delete()) {

            return $this->redirect(['group/manager', 'parent_id' => $modelService->getModel()->group_id]);
        }

        return false;
    }
}
