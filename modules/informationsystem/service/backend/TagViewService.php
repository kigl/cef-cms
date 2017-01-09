<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.01.2017
 * Time: 19:21
 */

namespace app\modules\informationsystem\service\backend;


use app\core\service\ViewService;

class TagViewService extends ViewService
{
    public function getModel()
    {
        return $this->getData('model');
    }

    public function getInformationsystemId()
    {
        return $this->getData('model')->informationsystem_id;
    }
}