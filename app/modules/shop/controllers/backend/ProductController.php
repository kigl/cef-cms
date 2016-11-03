<?php

namespace app\modules\shop\controllers\backend;


use Yii;
use yii\base\Model;
use app\modules\shop\models\Image;
use app\modules\shop\models\ProductProperty;
use app\modules\shop\models\ProductRelation;
use app\modules\shop\models\Product;
use app\modules\admin\components\controllers\BackendController;

class ProductController extends BackendController
{
    protected $image;
    protected $property;
    protected $relation;

    public function actionCreate($group_id)
    {
        $model = new Product();
        $model->group_id = (int)$group_id;
        $post = Yii::$app->request->post();
        $property = ProductProperty::initProperty($model);
        $relation = ProductRelation::initRelation($model);
        $images = Image::initImages($model);
        // подгатовка

        if ($model->load($post) and $model->validate()) {
            Model::loadMultiple($property, $post);
            Model::loadMultiple($images, $post);
            $relation->load($post);
            // загрузка

            // сохранение
            $model->save();
            Image::upload($model, 'imageUpload');
            Image::process();
            ProductProperty::saveProperty($model);
            ProductRelation::saveRelation($model);


            return $this->redirect(['group/manager', 'parent_id' => $model->group_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'property' => $property,
            'relation' => $relation,
            'images' => $images,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Product::findOne($id);
        $post = Yii::$app->request->post();
        // инициализация
        $property = ProductProperty::initProperty($model);
        $relation = ProductRelation::initRelation($model);
        $images = Image::initImages($model);

        if ($model->load($post) and $model->validate()) {
            Model::loadMultiple($property, $post);
            Model::loadMultiple($images, $post);
            $relation->load($post);

            $model->save();
            Image::upload($model, 'imageUpload');
            Image::process();
            ProductProperty::saveProperty($model);
            ProductRelation::saveRelation($model);

            return $this->redirect(['group/manager', 'parent_id' => $model->group_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'property' => $property,
            'relation' => $relation,
            'images' => $images,
        ]);
    }
}
