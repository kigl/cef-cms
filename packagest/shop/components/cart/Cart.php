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

namespace kigl\cef\module\shop\components\cart;


use Yii;
use yii\base\Component;
use yii\data\ActiveDataProvider;
use kigl\cef\module\shop\models\Cart as CartModel;
use kigl\cef\module\shop\models\CartItem;

class Cart extends Component implements CartInterface
{
    const ZERO_QTY = 0;

    public $cookieName = 'cart';

    public $cookieExpire;

    protected $cartCookie;

    protected $cart = null;

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
        $qty = (int)$qty;

        $cart = CartItem::find()
            ->where(['cart_id' => $this->getCart()->id, 'product_id' => $productId])
            ->with('product')
            ->one();

        if (!$cart) {
            $cart = new CartItem;
        }

        if ($cart->qty == $qty) {
            return null;
        }

        $cart->product_id = $productId;
        $cart->cart_id = $this->getCart()->id;
        $cart->qty = (int)$qty;
        $cart->price = $cart->product->price;

        if ($cart->qty == self::ZERO_QTY) {
            return $cart->delete();
        }

        return $cart->save();
    }

    public function delete($productId)
    {
        $model = CartItem::find()
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
        $cartId = $this->getCartId();
        $this->cart = null;

        return CartItem::deleteAll(['cart_id' => $cartId]);
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
        $cart = $this->getCart();

        if ($cart->items) {
            foreach ($cart->items as $item) {
                $result[] = $item->qty;
            }
        }


        return array_sum($result);
    }


    public function getSum()
    {
        $result = [];
        $cart = $this->getCart();

        if ($cart->items) {
            foreach ($cart->items as $item) {
                $result[] = $item->qty * $item->product->price;
            }
        }

        return array_sum($result);
    }

    public function getDataProvider()
    {
        $cartId = $this->getCartId();

        $dataProvider = new ActiveDataProvider([
            'query' => CartItem::find()
                ->indexBy('id')
                ->where(['cart_id' => $cartId])
                ->with(['product']),
            'sort' => false,
        ]);

        return $dataProvider;
    }

    public function getCart()
    {
        if ($this->cart === null) {
            $cartId = $this->getCartId();

            $this->cart = CartModel::find()
                ->with('items.product')
                ->where(['id' => $cartId])
                ->one();
        }

        /**
         * @TODO
         */
        $this->setUser($this->cart, Yii::$app->user->id);

        return $this->cart;
    }

    protected function setUser(CartModel $cart = null, $userId)
    {
        if ($cart === null) {
            return false;
        }

        if (!Yii::$app->user->isGuest) {
            if (!isset($cart->user_id)) {
                $cart->user_id = $userId;
                return $cart->save(false);
            }
        }

        return false;
    }

    public function createCart()
    {
        $model = new CartModel;

        if ($model->save(false)) {
            $this->cart = $model;

            return true;
        }

        return false;
    }

    public function getCartId()
    {
        /**
         * @todo
         * Если заказ удален, а кука с номером заказа жива, то ошибка
         */
        if ($cartId = $this->cartCookie->getRequestValue()) {
            $this->cartCookie->create($cartId);

            return $this->cartCookie->getResponseValue();
        }

        if ($this->createCart()) {
            $this->cartCookie->create($this->cart->id);

            return $this->cartCookie->getResponseValue();
        }
    }
}