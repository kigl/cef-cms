<?php
/**
 * Class AjaxController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers;

use Yii;
use yii\web\Controller;

class CartController extends Controller
{

    public function actionAdd()
    {
        if ($post = Yii::$app->request->post()) {
            Yii::$app->cart->add($post['productId'], $post['qty']);
        }
    }

    public function actionIndex()
    {
        $modelService = new CartModelService();
        $modelService->actionIndex();

        $viewService = (new CartViewService())->setData($modelService->getData());

        return $this->render('index', ['data' => $viewService]);
    }

    public function actionRefresh()
    {
         if ($post = Yii::$app->request->post()) {
             foreach ($post as $data) {
                 Yii::$app->cart->add($data['productId'], $data['qty']);
             }
         }
    }

    public function actionDelete($id)
    {
        if (Yii::$app->cart->delete($id)) {
            return true;
        }
    }
}