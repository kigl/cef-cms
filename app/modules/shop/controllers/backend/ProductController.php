<?php

namespace app\modules\shop\controllers\backend;

use Yii;
use app\modules\admin\components\controllers\BackendController;
use app\modules\shop\models\Product;

class ProductController extends BackendController
{
    public function actionCreate($group_id)
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post())) {
            $model->group_id = $group_id;

            if ($model->save()) return $this->redirect(['group/manager', 'parent_id' => $group_id]);
        }

        return $this->render('create', [
            'group_id' => $group_id,
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Product::findOne($id);

        if ($model->load(Yii::$app->request->post()) and $model->save()) {
            return $this->redirect(['group/manager', 'parent_id' => $model->group_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}