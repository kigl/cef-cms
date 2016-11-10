<?php

namespace app\modules\shop\controllers\backend;


use Yii;
use app\modules\shop\components\Controller;
use app\modules\shop\models\Product;
use app\modules\shop\models\ProductService;

class ProductController extends Controller
{
    protected $image;
    protected $property;
    protected $relation;

    public function actionCreate($group_id)
    {
        $model = new Product();
        $modelService = Yii::createObject(ProductService::class, [$model]);
        $modelService->setModelGroupId($group_id);

        if ($modelService->load(Yii::$app->request->post()) and $modelService->validate()) {

            $modelService->save();

            return $this->redirect(['product/update', 'id' => $modelService->getModel()->id]);
        }

        return $this->render('create', $modelService->getData());
    }

    public function actionUpdate($id)
    {
        $model = Product::findOne($id);
        $modelService = Yii::createObject(ProductService::class, [$model]);

        if ($modelService->load(Yii::$app->request->post()) and $modelService->validate()) {

            $modelService->save();

            return $this->redirect(['product/update', 'id' => $modelService->getModel()->id]);
        }

        return $this->render('update', $modelService->getData());
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
