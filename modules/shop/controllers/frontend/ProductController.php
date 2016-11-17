<?php
/**
 * Class ProductController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use app\modules\shop\components\FrontendController;
use app\modules\shop\models\Product;

class ProductController extends FrontendController
{
    public function actionView($id)
    {
        $model = Product::find()->where('id = :id', [':id' => $id])->one();

        return $this->render('view', ['model' => $model]);
    }
}
