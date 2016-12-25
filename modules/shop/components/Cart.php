<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 24.12.2016
 * Time: 21:14
 */

namespace app\modules\shop\components;

use Yii;
use yii\base\Component;
use yii\web\Cookie;

class Cart extends Component implements CartInterface
{
    const COOKIE_NAME_CART = 'cart';

    public function add($productId, $count)
    {
        $this->setCookie($productId, $count);
    }
    
    public function delete($productId)
    {
        
    }
    
    public function deleteAll()
    {
        // TODO: Implement deleteAll() method.
    }

    public function setCookie($productId, $count)
    {
        $time = 3600 * 30;

        $cookieResponse = Yii::$app->response->cookies;

        $cookieData = $this->getCookieValue();

        $cookieData[$productId] = $count;

        $cookieResponse->add(new Cookie([
            'name' => self::COOKIE_NAME_CART,
            'value' => json_encode($cookieData),
            'expire' => time() + $time,
            'path' => '/',
        ]));
    }

    public function getCookieValue()
    {
        $cookies = Yii::$app->request->cookies;

         if ($cookies->has(self::COOKIE_NAME_CART)) {
             return json_decode($cookies->get(self::COOKIE_NAME_CART)->value, true);
         }

        return [];
    }
}