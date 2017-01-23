<?php
/**
 * Class OrderViewService
 * @package app\modules\shop\service\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;


use app\core\service\ViewService;

class OrderViewService extends ViewService
{
    public function getModel()
    {
        return $this->getData('model');
    }
}