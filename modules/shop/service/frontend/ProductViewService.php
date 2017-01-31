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

    public function getMetaDescription()
    {
        return $this->getData('model')->meta_description;
    }

    public function getCode()
    {
        return $this->getData('model')->code;
    }

    public function getPrice()
    {
        return Yii::t('shop', 'Price: {price, number, currency}', ['price' => $this->getData('model')->price]);
    }

    public function getContent()
    {
        return $this->getData('model')->content;
    }

    public function getGroupId()
    {
        return $this->getData('model')->group_id;
    }

    public function getGroupName()
    {
        return Yii::t('shop', 'Group: {group}', ['group' => $this->getData('model')->group->name]);
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