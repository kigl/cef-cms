<?php
/**
 * Class OrderController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;


use Yii;
use app\modules\shop\service\frontend\OrderViewService;
use app\modules\shop\components\FrontendController;
use app\modules\shop\service\frontend\OrderModelService;

class OrderController extends FrontendController
{
    public function actionIndex()
    {
        $modelService = new OrderModelService();
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'orderId' => Yii::$app->cart->getOrderId(),
        ]);
        $modelService->actionIndex();

        $viewService = (new OrderViewService())->setData($modelService->getData());



        //return $this->render('index', ['data' => $viewService]);
    }
}