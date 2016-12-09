<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.12.2016
 * Time: 22:37
 */

namespace app\modules\shop\service\frontend;


use app\core\service\ViewService;

class ProductViewService extends ViewService
{
    public function getName()
    {
        return $this->getData('model')->name;
    }

    public function getId()
    {
        return $this->getData('model')->id;
    }

    public function getGroupId()
    {
        return $this->getData('model')->group_id;
    }

    public function getGroupName()
    {
        return $this->getData('model')->group->name;
    }

    public function getModel()
    {
        return $this->getData('model');
    }
}