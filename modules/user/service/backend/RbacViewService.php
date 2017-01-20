<?php
/**
 * Class RbacViewService
 * @package app\modules\user\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\service\backend;


use app\core\service\ViewService;

class RbacViewService extends ViewService
{
    public function getModel()
    {
        return $this->getData('model');
    }

    public function getItem()
    {
        return $this->getData('item');
    }
}