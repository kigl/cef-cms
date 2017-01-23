<?php
/**
 * Class OrderModelService
 * @package app\modules\shop\service\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;


use Yii;
use app\modules\shop\models\base\OrderItem;
use app\core\service\ModelService;
use app\modules\shop\models\forms\OrderForm;
use app\modules\shop\models\base\Order;

class OrderModelService extends ModelService
{
    const EMPTY_CART = 95;

    protected $field;

    protected $cartService;

    protected $order;

    public function __construct()
    {
        $this->cartService = Yii::$app->cart;
    }

    public function actionIndex(array $params)
    {
        $model = new OrderForm();

        if ($this->cartService->isEmptyCart()) {
            $this->setExecutedAction(self::EMPTY_CART);
        }

        if ($model->load($params['post']) && $model->validate()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_VALIDATE);
        }

        if ($this->hasExecutedAction(self::EXECUTED_ACTION_VALIDATE)) {
            $this->cartService->saveOrder($model->attributes);
            $this->cartService->saveOrderItem();
            $this->cartService->clear();
            $this->cartService->newOrder(); //создадим новый пустой заказ

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }
}
