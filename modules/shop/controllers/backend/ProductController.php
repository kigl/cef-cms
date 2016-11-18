<?php

namespace app\modules\shop\controllers\backend;

use Yii;
use app\modules\shop\components\BackendController;
use app\modules\shop\models\backend\ProductService;

class ProductController extends BackendController
{
    protected $image;
    protected $property;
    protected $relation;

    public function actionCreate($group_id)
    {
        $modelService = new ProductService();
        $modelService->setQuery([
            'group_id' => $group_id,
        ]);
        $modelService->setRequestData(Yii::$app->request->post());
        $modelService->create();

        if ($modelService->load() and $modelService->save()) {

            return $this->redirect(['product/update', 'id' => $modelService->getModel()->id]);
        }

        return $this->render('create', $modelService->getViewData());
    }

    public function actionUpdate($id)
    {
        $modelService = new ProductService();
        $modelService->setQuery([
            'id' => $id,
        ]);
        $modelService->setRequestData(Yii::$app->request->post());
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
