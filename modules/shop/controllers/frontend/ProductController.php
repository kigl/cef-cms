<?php
/**
 * Class ProductController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use app\modules\shop\components\FrontendController;
use app\modules\shop\models\frontend\ProductService;
use app\modules\shop\models\Product;

class ProductController extends FrontendController
{
    public function actionView($id)
    {
        $modelService = new ProductService();
        $modelService->setQuery(['id' => $id]);
        $modelService->view();

        return $this->render('view', $modelService->getViewData());
    }
}
