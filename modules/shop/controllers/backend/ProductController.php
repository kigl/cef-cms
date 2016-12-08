<?php

namespace app\modules\shop\controllers\backend;

use app\modules\shop\service\backend\ProductViewService;
use Yii;
use app\modules\shop\components\BackendController;
use app\modules\shop\service\backend\ProductService;

class ProductController extends BackendController
{
    protected $image;
    protected $property;
    protected $relation;

    public function actionCreate($group_id)
    {
        $modelService = new ProductService();
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
        $modelService = new ProductService();
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->update();

        if ($modelService->load() and $modelService->save()) {

            return $this->redirect(['product/update', 'id' => $modelService->getModel()->id]);
        }

        return $this->render('update', $modelService->getViewData());
    }

    public function actionDelete($id)
    {
        $model = Product::findOne($id);
        $modelService = new ProductService($model);

        if ($modelService->delete()) {

            return $this->redirect(['group/manager', 'parent_id' => $modelService->getModel()->group_id]);
        }

        return false;
    }
}
