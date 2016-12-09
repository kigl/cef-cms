<?php
/**
 * Class ProductController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use Yii;
use app\modules\shop\service\frontend\ProductModelService;
use app\modules\shop\components\FrontendController;
use app\modules\shop\service\frontend\ProductViewService;

class ProductController extends FrontendController
{
    public function actionView($id)
    {
        $modelService = new ProductModelService();
        $modelService->setRequestData(['get' => Yii::$app->request->getQueryParams()]);
        $modelService->view();

        $viewService = (new ProductViewService())->setData($modelService->getData());

        return $this->render('view', ['data' => $viewService]);
    }
}
