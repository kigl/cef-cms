<?php
/**
 * Class OrderModelService
 * @package app\modules\shop\service\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;


use Yii;
use app\modules\shop\models\base\Order;
use app\modules\shop\models\base\OrderItem;
use app\core\service\ModelService;
use app\modules\shop\models\forms\OrderForm;

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
            $this->newOrder($model->attributes); //создадим новый пустой заказ
            $this->cartService->clear();

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);

        }

        $this->setData([
            'model' => $model,
        ]);
    }

    protected function newOrder(array $attributes)
    {
        $model = new Order();

        $model->status = Order::STATUS_ACCEPTED;
        $model->attributes = $attributes;
        $model->save(false);

        $this->saveOrderItem($model);
    }

    protected function saveOrderItem(Order $model)
    {
        foreach ($this->cartService->getCart()->items as $item) {
            $orderItem = new OrderItem([
                'order_id' => $model->id,
                'name' => $item->product->name,
                'qty' => $item->qty,
                'price' => $item->product->price,
            ]);

            $orderItem->save(false);
        }
    }
}
