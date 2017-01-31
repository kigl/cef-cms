<?php
/**
 * Class ProductViewService
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;

use Yii;
use app\core\service\ViewService;

class ProductViewService extends ViewService
{

    public function getId()
    {
        return $this->getData('model')->id;
    }

    public function getGroupId()
    {
        return $this->getData('model')->group_id;
    }

    public function getModel()
    {
        $data = $this->getData('model');

        return $data;
    }

    public function getParentId()
    {
        return $this->getData('model')->parent_id;
    }

    public function getProperties()
    {
        return $this->getData('model')->properties;
    }


    public function getDataProvider()
    {
        return $this->getData('dataProvider');
    }

    public function getImages()
    {
        return $this->getData('model')->images;
    }

    public function getName()
    {
        return $this->getData('model')->name;
    }
}