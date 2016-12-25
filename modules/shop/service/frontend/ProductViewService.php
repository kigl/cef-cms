<?php

namespace app\modules\shop\service\frontend;

use Yii;
use app\core\service\ViewService;

class ProductViewService extends ViewService
{
    public function getId()
    {
        return $this->getData('model')->id;
    }

    public function getName()
    {
        return $this->getData('model')->name;
    }

    public function getCode()
    {
        return $this->getData('model')->code;
    }

    public function getPrice()
    {
        return $this->getData('model')->price;
    }

    public function getGroupId()
    {
        return $this->getData('model')->group_id;
    }

    public function getGroupName()
    {
        return $this->getData('model')->group->name;
    }

    public function getGroupMetaDescription()
    {
        return $this->getData('model')->group->meta_description;
    }

    public function getModel()
    {
        return $this->getData('model');
    }

    public function getAlias()
    {
        return $this->getData('model')->alias;
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

    public function getUrl($route = '/shop/product/views')
    {
        $id = $this->isAlias() ? $this->getAlias : $this->getId();

        return Url::to([$route, 'id' => $id]);
    }

    protected function isAlias()
    {
        return Yii::$app->getModule('shop')->urlAlias;
    }

    public function getMainImage()
    {
        $data = $this->getData('mainImage');

        return $data ? $data : null;
    }

    public function getProperty()
    {
        $ar = [];
        foreach ($this->getData('property') as $property) {
            $ar[$property->property->name] = $property->value;
        }

        return $ar;
    }

    public function getDataProvider()
    {
        return $this->getData('dataProvider');
    }
}