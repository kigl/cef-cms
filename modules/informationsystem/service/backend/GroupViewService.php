<?php
/**
 * Class GroupViewService
 * @package app\modules\informationsystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\service\backend;


use app\core\service\ViewService;

class GroupViewService extends ViewService
{
    public function getModel()
    {
        return $this->getData('model');
    }

    public function getInformationsystemId()
    {
        return $this->getData('informationsystemId');
    }

    public function getParentId()
    {
        return $this->getData('parentId');
    }
}