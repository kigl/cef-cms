<?php
/**
 * Class CartProductModel
 * @package app\modules\shop\components\cart
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\components\cart;

use Yii;
use yii\helpers\ArrayHelper;

class CartProductModel
{
    public $classModel;

    protected $products;

    // @todo
    public function getProducts()
    {
        $productsId = $this->getProductsId();

        $class = $this->classModel;

        $result = $class::getDb()->cache( function ($db) use ($class, $productsId) {
            return $class::find()->where(['in', 'id', $productsId])->indexBy('id')->all();
        });

        return $result;
        //return $class::find()->where(['in', 'id', $productsId])->indexBy('id')->all();
    }

    // @todo
    public function getProductSum($productId)
    {
        $products = $this->getProducts();

        return $products[$productId]->price * $this->getProductCount($productId);
    }

    // @todo
    public function getProductsSum()
    {
        $products = $this->getProducts();

        $result = [];
        foreach ($products as $product) {
            $result[] = $this->getProductSum($product->id);
        }

        return array_sum($result);
    }

    public function getCount()
    {
        return array_sum($this->getCookieValue());
    }

    public function getProductCount($productId)
    {
        $data = Yii::$app->cart->cookie->getValue();
        return ArrayHelper::getValue($data, $productId);
    }

    public function getProductsId()
    {
        return array_keys($this->getCookieValue());
    }

    protected function getCookieValue()
    {
        return Yii::$app->cart->cookie->getValue();
    }
}