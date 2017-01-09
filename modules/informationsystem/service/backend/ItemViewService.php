<?php
/**
 * Class ItemViewService
 * @package app\modules\informationsystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\service\backend;


use app\core\service\ViewService;

class ItemViewService extends ViewService
{
    public function getModel()
    {
        return $this->getData('model');
    }
}