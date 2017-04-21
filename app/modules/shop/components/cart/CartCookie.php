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
    protected $name;

    protected $expire;

    public function create($value)
    {
        Yii::$app->response->cookies->add(new Cookie([
            'name' => $this->name,
            'value' => $value,
            'expire' => $this->expire,
        ]));
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setExpire($expire)
    {
        $this->expire = $expire;
    }

    public function getRequestValue()
    {
        return $this->getRequestCookie() ? $this->getRequestCookie()->value : null;
    }

    public function getResponseValue()
    {
        return $this->getResponseCookie() ? $this->getResponseCookie()->value : null;
    }

    protected function getRequestCookie()
    {
        return Yii::$app->request->cookies->get($this->name);
    }

    protected function getResponseCookie()
    {
        return Yii::$app->response->cookies->get($this->name);
    }
}
