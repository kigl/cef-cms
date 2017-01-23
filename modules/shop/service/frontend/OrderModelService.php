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
            $this->saveOrder($model->attributes);
            $this->saveOrderItem();
            $this->cartService->clear();
            $this->cartService->newOrder(); //создадим новый пустой заказ

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }

    protected function saveOrder(array $attributes)
    {
        $orderId = $this->cartService->getOrderId();
        $order = Order::findOne($orderId);

        $order->status = Order::STATUS_ACCEPTED;
        $order->attributes = $attributes;
        return $order->save(false);
    }

    protected function saveOrderItem()
    {
        foreach ($this->cartService->getCart() as $item) {
            $orderItem = new OrderItem([
                'order_id' => $this->cartService->getOrderId(),
                'name' => $item->product->name,
                'qty' => $item->qty,
                'price' => $item->product->price,
            ]);

            $orderItem->save(false);
        }
    }
}
