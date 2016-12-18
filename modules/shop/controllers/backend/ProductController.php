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
        $modelService->setRequestData([
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        );
        $modelService->create();
        $viewService = (new ProductViewService())->setData($modelService->getData());

        if ($modelService->load() and $modelService->save()) {

            return $this->redirect(['product/update', 'id' => $modelService->getModel()->id]);
        }

        return $this->render('create', ['data' => $viewService]);
    }

    public function actionUpdate($id)
    {
        $modelService = new ProductModelService();
        $modelService->setRequestData([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->update();

        $viewService = (new ProductViewService())->setData($modelService->getData());

        if ($modelService->load() and $modelService->save()) {

            return $this->redirect(['product/update', 'id' => $viewService->getId()]);
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
