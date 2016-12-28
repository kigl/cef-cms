<?php
/**
 * Class Cart
 * @package app\modules\shop\components\cart
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\components\cart;


use Yii;
use yii\base\Component;
use yii\data\ActiveDataProvider;
use yii\web\Cookie;
use yii\web\HttpException;

class Cart extends Component implements CartInterface
{
    public $orderModelClass;

    public $cartModelClass;

    public $productModelClass;

    public $cookieKey = 'cart';

    public $cookieTimeDays = 1;

    protected $order = null;

    public function add($productId, $qty = 1)
    {
        $cartModelClass = $this->cartModelClass;
        $qty = (int)$qty;

        $cart = $cartModelClass::findOne(['order_id' => $this->getOrder()->id, 'product_id' => $productId]);

        if (!$cart) {
            $cart = new $cartModelClass;
        }

        $cart->product_id = $productId;
        $cart->order_id = $this->getOrder()->id;
        $cart->qty = (int)$qty;

        return $cart->save();
    }

    public function delete()
    {

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

    public function getOrder()
    {
        $model = $this->orderModelClass;

        if ($this->order === null) {
            $orderId = $this->getOrderIdFromCookie();

            $this->order = $model::find()->with('cart.product')->where(['id' => $orderId])->one();
        }

        return $this->order;
    }

    public function getDataProvider()
    {
        $orderId = $this->getOrderIdFromCookie();
        $cartModelClass = $this->cartModelClass;

        $dataProvider = new ActiveDataProvider([
            'query' => $cartModelClass::find()->indexBy('id')->where(['order_id' => $orderId])->with(['product']),
        ]);

        return $dataProvider;
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

    protected function getOrderIdFromCookie()
    {
        if (Yii::$app->request->cookies->has($this->cookieKey)) {
            $cookieValue = Yii::$app->request->cookies->get($this->cookieKey);

            $this->createCookie($cookieValue);

            return $this->getResponseCookieValue();
        }

        if ($this->createOrder()) {
            $this->createCookie($this->order->id);

            return $this->getResponseCookieValue();
        }

        throw new HttpException(500);
    }

    protected function createCookie($value)
    {
        Yii::$app->response->cookies->add(new Cookie([
            'name' => $this->cookieKey,
            'value' => $value,
            'expire' => $this->getCookieTime(),
        ]));
    }

    protected function getResponseCookieValue()
    {
        return Yii::$app->response->cookies->get($this->cookieKey)->value;
    }

    protected function getCookieTime()
    {
        return time() + 3600 * $this->cookieTimeDays;
    }
}