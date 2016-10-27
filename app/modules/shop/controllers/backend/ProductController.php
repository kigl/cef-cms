<?php

namespace app\modules\shop\controllers\backend;

use Yii;
use app\modules\shop\models\Product;
use app\modules\shop\models\ProductProperty;
use app\modules\shop\models\Property;
use app\modules\admin\components\controllers\BackendController;
use yii\base\Model;

class ProductController extends BackendController
{
    public function actionCreate($group_id)
    {
        $model = new Product();
        $productProperty = $model->getInitProperty();
        $post = Yii::$app->request->post();

        if ($model->load($post) and $model->validate() and Model::loadMultiple($productProperty, $post)) {
            $model->group_id = $group_id;
            $model->save();
            $this->processSaveProperty($productProperty, $model);

            return $this->redirect(['group/manager', 'parent_id' => $group_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'productProperty' => $productProperty,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Product::findOne($id);
        $productProperty = $model->getInitProperty();
        $post = Yii::$app->request->post();

        if ($model->load(Yii::$app->request->post()) and $model->save() and Model::loadMultiple($productProperty, $post)) {
            $this->processSaveProperty($productProperty, $model);

            return $this->redirect(['group/manager', 'parent_id' => $model->group_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'productProperty' => $productProperty,
        ]);
    }

    protected function processSaveProperty($propertys, Product $model)
    {
        foreach ($propertys as $property) {
            $property->product_id = $model->id;
            
            if ($property->validate()) {
                if(!empty($property->value)) {
                    $property->save(false);
                }
            }
        }
    }
}
