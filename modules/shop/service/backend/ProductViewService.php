<?php
/**
 * Class ProductViewService
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use app\core\service\ViewService;

class ProductViewService extends ViewService
{
    public function getGroupId()
    {
        $data = $this->getData('model');

        $dataGetGroupId = $this->getData('group_id');

        return $data->group_id ? $data->group_id : $dataGetGroupId;
    }

    public function getModel()
    {
        $data = $this->getData('model');

        return $data;
    }

    public function getProperty()
    {
        return $this->getData('property');
    }

    public function getModification()
    {
        return $this->getData('modification');
    }

    public function getImages()
    {
        return $this->getData('images');
    }
}