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
use yii\filters\AccessControl;

class OrderController extends FrontendController
{
    public function behaviors()
    {
        return [
            'accessControl' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['register'],
                    ],
                ],
            ],
            // сделать фильтр проверки наличие товаров в корзине и наличие заказа
        ];
    }

    public function actionIndex()
    {
        $modelService = Yii::createObject(OrderModelService::class);
        $modelService->actionIndex([
            'post' => Yii::$app->request->post(),
        ]);

        if ($modelService->hasExecutedAction($modelService::EMPTY_CART)) {
            return $this->redirect(['/shop/cart']);
        }

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->render('accepted');
        }

        $viewService = (new OrderViewService())->setData($modelService->getData());

        return $this->render('index', ['data' => $viewService]);
    }
}