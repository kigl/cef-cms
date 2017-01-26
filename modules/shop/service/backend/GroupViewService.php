<?php
/**
 * Class GroupViewService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use app\core\service\ViewService;

class GroupViewService extends ViewService
{
    public function getModel()
    {
        return $this->getData('model');
    }

    public function getParentId()
    {
        return $this->getData('parentId');
    }
}