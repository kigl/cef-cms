<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.01.2017
 * Time: 19:09
 */

namespace app\modules\shop\service\backend;


use app\core\service\ViewService;

class OrderViewService extends ViewService
{
    public function getDataProvider()
    {
        return $this->getData('dataProvider');
    }

    public function getModel()
    {
        return $this->getData('model');
    }
}