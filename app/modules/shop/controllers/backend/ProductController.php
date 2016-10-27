<?php

namespace app\modules\shop\controllers\backend;

use Yii;
use app\modules\shop\models\Product;
use app\modules\shop\models\ProductProperty;
use app\modules\shop\models\Property;
use app\modules\admin\components\controllers\BackendController;

class ProductController extends BackendController
{
    public function actionCreate($group_id)
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) and $model->validate()) {
            $model->group_id = $group_id;

            return $this->redirect(['group/manager', 'parent_id' => $group_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Product::findOne($id);
        $property = $this->initProperty($model);

        if ($model->load(Yii::$app->request->post()) and $model->save()) {

            return $this->redirect(['group/manager', 'parent_id' => $model->group_id]);
        }


        return $this->render('update', [
            'model' => $model,
            'property' => $property,
        ]);
    }

    protected function initProperty(Product $model)
    {
        $productProperty = $model->getProductProperty()->with('property')->indexBy('property_id')->all();
        $allProperty = Property::find()->indexBy('id')->all();

        foreach (array_diff_key($allProperty, $productProperty) as $property) {
            $productProperty[$property->id] = new ProductProperty(['property_id' => $property->id]);
        }

        return $productProperty;
    }
}