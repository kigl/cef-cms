<?php
/**
 * Class ProductController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use app\modules\shop\models\Product;

class ProductController extends Controller
{
    public function actionGetValue($id)
    {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;

        $model = Product::findOne($id);

        $result = [
            'id' => $model->id,
            'price' => Yii::t('shop', 'Price: {price, number, currency}', ['price' => $model->price]),
        ];

        echo json_encode($result);
    }

    public function actionView($id, $shop_id, $alias = '')
    {
        echo get_called_class(); exit;

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

        if (!Yii::$app->request->isPjax && Yii::$app->request->isAjax) {
            return $this->renderAjax('view', ['data' => $modelService->getData()]);
        }

        return $this->render('view', ['data' => $modelService->getData()]);
    }

    /*
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
    */
}
