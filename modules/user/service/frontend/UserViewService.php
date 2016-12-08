<?php
/**
 * Class UserViewService
 * @package app\modules\user\service\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\service\frontend;


use app\core\service\ViewService;

class UserViewService extends ViewService
{
    public function getModel()
    {
        return $this->getData('model');
    }

    public function getField()
    {
        return $this->getData('field');
    }
}