<?php
/**
 * Class ProductController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use Yii;
use app\modules\shop\components\FrontendController;
use app\modules\shop\models\frontend\ProductService;

class ProductController extends FrontendController
{
    public function actionView($id)
    {
        $modelService = new ProductService();
        $modelService->setRequestData(['get' => Yii::$app->request->getQueryParams()]);
        $modelService->view();

        return $this->render('view', $modelService->getData());
    }
}
