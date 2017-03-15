<?php
/**
 * Class CartViewService
 * @package app\modules\shop\service\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;


use app\core\service\ViewService;

class CartViewService extends ViewService
{
    public function getDataProvider()
    {
        return $this->getData('cartService')->getDataProvider();
    }
}
