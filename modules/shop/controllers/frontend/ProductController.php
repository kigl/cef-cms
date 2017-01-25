<?php
/**
 * Class ProductController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use app\modules\shop\service\frontend\GroupViewService;
use Yii;
use app\core\actions\View;
use app\modules\shop\components\FrontendController;
use app\modules\shop\service\frontend\ProductModelService;
use app\modules\shop\service\frontend\ProductViewService;
use yii\web\HttpException;

class ProductController extends FrontendController
{
    public function actionView($id, $alias = '')
    {
        $modelService = new ProductModelService();
        $modelService->view($id, $alias);

        if ($modelService->hasError($modelService::ERROR_NOT_MODEL)) {
            throw new HttpException(404);
        }

        if ($modelService->hasError($modelService::ERROR_NOT_MODEL_ALIAS)) {
            $this->redirect([
                '/shop/product/view',
                'id' => $id,
                'alias' => $modelService->getData('model')->alias], 301);
        }

        $viewService = (new ProductViewService())->setData($modelService->getData());


        if (!Yii::$app->request->isPjax && Yii::$app->request->isAjax) {
            return $this->renderAjax('view', ['data' => $viewService]);
        }


        return $this->render('view', ['data' => $viewService]);
    }

    public function actionSearch($value)
    {
        $modelService = new ProductModelService();
        $modelService->setRequestData([
            'get' => Yii::$app->request->getQueryParams()
        ]);
        $modelService->search();

        $viewService = new ProductViewService();
        $viewService->setData($modelService->getData());

        return $this->render('search', ['data' => $viewService]);
    }
}
