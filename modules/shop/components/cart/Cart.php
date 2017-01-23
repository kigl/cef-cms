<?php
/**
 * Class Cart
 * @package app\modules\shop\components\cart
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


/**
 * @todo
 * лапшекод, много условных операторов, продумать структура, разнести обязаннасти
 */

namespace app\modules\shop\components\cart;


use Yii;
use yii\base\Component;
use yii\data\ActiveDataProvider;
use app\modules\shop\models\base\Order;
use app\modules\shop\models\base\OrderItem;

class Cart extends Component implements CartInterface
{
    const ZERO_QTY = 0;

    public $orderModelClass;

    public $cartModelClass;

    public $productModelClass;

    public $cookieName = 'cart';

    public $cookieExpire;

    protected $cartCookie;

    protected $order = null;

    public function __construct(
        CartCookie $cartCookie,
        $config = [])
    {
        $this->cartCookie = $cartCookie;
        parent::__construct($config);
    }

    public function init()
    {
        $this->cartCookie->setName($this->cookieName);
        $this->cartCookie->setExpire($this->cookieExpire);

        parent::init();
    }

    public function add($productId, $qty = 1)
    {
        $cartModelClass = $this->cartModelClass;
        $qty = (int)$qty;

        $cart = $cartModelClass::find()
            ->where(['order_id' => $this->getOrder()->id, 'product_id' => $productId])
            ->with('product')
            ->one();

        if (!$cart) {
            $cart = new $cartModelClass;
        }

        if ($cart->qty == $qty) {
            return null;
        }

        $cart->product_id = $productId;
        $cart->order_id = $this->getOrder()->id;
        $cart->qty = (int)$qty;
        $cart->price = $cart->product->price;

        if ($cart->qty == self::ZERO_QTY) {
            return $cart->delete();
        }

        return $cart->save();
    }

    public function delete($productId)
    {
        $cartModelClass = $this->cartModelClass;

        $model = $cartModelClass::find()
            ->select('id')
            ->where(['id' => $productId])
            ->one();

        if ($model) {
            return $model->delete();
        }

        return false;
    }

    public function clear()
    {
        $cartModelClass = $this->cartModelClass;

        return $cartModelClass::deleteAll();
    }

    public function isEmptyCart()
    {
        if ($this->getCount() > 0) {
            return false;
        }

        return true;
    }

    public function getCount()
    {
        $result = [];
        if ($cart = $this->getCart()) {
            foreach ($cart as $item) {
                $result[] = $item->qty;
            }
        }


        return array_sum($result);
    }


    public function getSum()
    {
        $result = [];

        if ($cart = $this->getCart()) {
            foreach ($cart as $item) {
                $result[] = $item->qty * $item->product->price;
            }
        }

        return array_sum($result);
    }

    public function getDataProvider()
    {
        $orderId = $this->getOrderId();
        $cartModelClass = $this->cartModelClass;

        $dataProvider = new ActiveDataProvider([
            'query' => $cartModelClass::find()
                ->indexBy('id')
                ->where(['order_id' => $orderId])
                ->with(['product']),
            'sort' => false,
        ]);

        return $dataProvider;
    }

    public function getOrder()
    {
        $model = $this->orderModelClass;

        if ($this->order === null) {
            $orderId = $this->getOrderId();

            $this->order = $model::find()
                ->with('cart.product')
                ->where(['id' => $orderId])
                ->one();
        }

        /**
         * @TODO
         */
        $this->setUser($this->order, Yii::$app->user->id);

        return $this->order;
    }

    public function getCart()
    {
        if ($order = $this->getOrder()) {
            return $order->cart;
        }

        return null;
    }

    protected function setUser(Order $order = null, $userId)
    {
        if ($order === null) {
            return false;
        }

        if (!Yii::$app->user->isGuest) {
            if (!isset($order->user_id)) {
                $order->user_id = $userId;
                return $order->save(false);
            }
        }

        return false;
    }

    public function createOrder()
    {
        $orderClass = $this->orderModelClass;

        $model = new $orderClass;

        if ($model->save(false)) {
            $this->order = $model;

            return true;
        }

        return false;
    }

    public function getOrderId()
    {
        /**
         * @todo
         * Если заказ удален, а кука с номером заказа жива, то ошибка
         */
        if ($orderId = $this->cartCookie->getRequestValue()) {
            $this->cartCookie->create($orderId);

            return $this->cartCookie->getResponseValue();
        }

        if ($this->createOrder()) {
            $this->cartCookie->create($this->order->id);

            return $this->cartCookie->getResponseValue();
        }
    }

    public function newOrder()
    {
        if ($this->createOrder()) {
            $this->cartCookie->create($this->order->id);
        }
    }

    public function saveOrder(array $attributes)
    {
        $orderId = $this->getOrderId();
        $orderModelClass = $this->orderModelClass;

        $order = $orderModelClass::findOne($orderId);

        $order->status = Order::STATUS_ACCEPTED;
        $order->attributes = $attributes;
        return $order->save(false);
    }

    public function saveOrderItem()
    {
        foreach ($this->getCart() as $item) {
            $orderItem = new OrderItem([
                'order_id' => $this->getOrderId(),
                'name' => $item->product->name,
                'qty' => $item->qty,
                'price' => $item->product->price,
            ]);

            $orderItem->save(false);
        }
    }
}