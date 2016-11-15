<?php
/**
 * Class GroupController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use app\modules\shop\components\FrontendController;
use app\modules\shop\models\Product;

class GroupController extends FrontendController
{
    public function actionView($id)
    {
        $model = Product::findAll(['group_id' => $id]);

        return $this->render('view', ['model' => $model]);
    }
}