<?php
/**
 * Class UserViewService
 * @package app\modules\user\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\service\backend;


use app\core\service\ViewService;

class UserViewService extends ViewService
{
    public function getModel()
    {
        return $this->getData('model');
    }

    public function getFieldModels()
    {
        return $this->getData('field');
    }
}