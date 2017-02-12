<?php

namespace app\modules\shop\service\frontend;

use Yii;
use app\core\service\ViewService;

class ProductViewService extends ViewService
{

    public function getModel()
    {
        return $this->getData('model');
    }

    public function getImages()
    {
        return $this->getData('images');
    }

    public function getTitle()
    {
        $data = $this->getData('model');
        $title = $data->meta_title ? $data->meta_title : $data->name;

        return $title;
    }
    
    public function getMainImage()
    {
        $data = $this->getData('mainImage');

        return $data ? $data : null;
    }

    public function getProperties()
    {
        $ar = [];
        foreach ($this->getData('properties') as $property) {
            $ar[$property->property->name] = $property->value;
        }

        return $ar;
    }

    public function getDataProvider()
    {
        return $this->getData('dataProvider');
    }

    public function getSubProducts()
    {
        return $this->getData('subProducts');
    }
}