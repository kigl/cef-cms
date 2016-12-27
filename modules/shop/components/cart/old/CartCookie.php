<?php
/**
 * Class CartCookie
 * @package app\modules\shop\components\cart
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\components\cart;

use Yii;
use yii\web\Cookie;

class CartCookie
{
    public $name = 'cart';

    public $timeDays = 1;

    public function setValue($productId, $count)
    {
        $cookieResponse = Yii::$app->response->cookies;

        $cookieData = $this->getValue();

        $cookieData[$productId] = $count;

        $cookieResponse->add(new Cookie([
            'name' => $this->name,
            'value' => json_encode($cookieData),
            'expire' => $this->getTime(),
            'path' => '/',
        ]));
    }

    public function getValue()
    {
        $cookies = Yii::$app->request->cookies;

        if ($cookies->has($this->name)) {
            return json_decode($cookies->get($this->name)->value, true);
        }

        return [];
    }

    protected function getTime()
    {
        return time() * 3600 * $this->timeDays;
    }
}