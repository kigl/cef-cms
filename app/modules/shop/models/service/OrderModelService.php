<?php
/**
 * Class OrderModelService
 * @package app\modules\shop\service\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\shop\models\service\frontend;


use Yii;
use kigl\cef\module\shop\models\Order;
use kigl\cef\module\shop\models\OrderItem;
use kigl\cef\core\service\ModelService;
use kigl\cef\module\shop\models\forms\OrderForm;

class OrderModelService extends ModelService
{
    const EMPTY_CART = 95;

    protected $field;

    protected $cartService;

    protected $order;

    public function __construct($config = [])
    {
        $this->cartService = Yii::$app->cart;

        parent::__construct($config);
    }

    public function actionIndex(array $params)
    {
        $form = new OrderForm();

        if ($this->cartService->isEmptyCart()) {
            $this->setExecutedAction(self::EMPTY_CART);
        }

        if ($form->load($params['post']) && $form->validate()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_VALIDATE);
        }

        if ($this->hasExecutedAction(self::EXECUTED_ACTION_VALIDATE)) {
            $this->newOrder($form->attributes); //создадим новый пустой заказ
            $this->cartService->clear();

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);

        }

        $this->setData([
            'model' => $form,
        ]);
    }

    protected function newOrder(array $attributes)
    {
        $model = new Order();

        $model->status = Order::STATUS_ACCEPTED;
        $model->attributes = $attributes;
        $model->sum = $this->cartService->getSum();
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
