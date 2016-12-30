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
        return $this;
    }

    public function getCount()
    {
        $order = $this->getOrder();

        $result = [];
        foreach ($order->cart as $cart) {
            $result[] = $cart->qty;
        }

        return array_sum($result);
    }

    public function getSum()
    {
        $order = $this->getOrder();

        $result = [];
        foreach ($order->cart as $cart) {
            $result[] = $cart->qty * $cart->product->price;
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

        $this->setUser($this->order, Yii::$app->user->id);

        return $this->order;
    }

    protected function setUser(Order $order, $userId)
    {
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

        if ($model->save()) {
            $this->order = $model;

            return true;
        }

        return false;
    }

    protected function getOrderId()
    {
        if ($orderId = $this->cartCookie->getRequestValue()) {
            $this->cartCookie->create($orderId);

            return $this->cartCookie->getResponseValue();
        }

        if ($this->createOrder()) {
            $this->cartCookie->create($this->order->id);

            return $this->cartCookie->getResponseValue();
        }
    }
}