<?php

namespace app\modules\shop\controllers\backend;

use app\modules\shop\models\Image;
use app\modules\shop\models\ProductProperty;
use app\modules\shop\models\ProductRelation;
use Yii;
use yii\base\Model;
use app\modules\shop\models\Product;
use app\modules\admin\components\controllers\BackendController;
use yii\web\UploadedFile;

class ProductController extends BackendController
{
    public function actionCreate($group_id)
    {
        $model = new Product();
        $model->group_id = (int)$group_id;
        $post = Yii::$app->request->post();
        $productProperty = $model->getInitProperty();
        $productRelation = $model->getInitProductRelation();

        if ($model->load($post) and $model->validate() and Model::loadMultiple($productProperty, $post) and $productRelation->load($post)) {
            $model->save();
            $model->saveProperty($productProperty);
            $model->saveProductRelation($productRelation);

            return $this->redirect(['group/manager', 'parent_id' => $group_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'productProperty' => $productProperty,
            'productRelation' => $productRelation,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Product::findOne($id);
        $post = Yii::$app->request->post();
        $productProperty = ProductProperty::initProperty($model);
        $productRelation = ProductRelation::initProductRelation($model);

        if ($model->load($post) and $model->validate()) {
            Model::loadMultiple($productProperty, $post);
            $productRelation->load($post);

            $model->save();
            Image::uploadImages($model, 'image');
            ProductProperty::saveProperty($model);
            ProductRelation::saveProductRelation($model);

            return $this->redirect(['group/manager', 'parent_id' => $model->group_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'productProperty' => $productProperty,
            'productRelation' => $productRelation,
        ]);
    }
}
