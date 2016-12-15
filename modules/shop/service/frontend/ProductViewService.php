<?php
/**
 * Class ProductViewService
 * @package app\modules\shop\service\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;

use Yii;
use yii\helpers\Url;
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

    public function getUrl($route = '/shop/product/view')
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
        return $this->getData('model')->getMainImage();
    }

    public function getProperty()
    {
        $ar = [];

        $i = 0;
        foreach ($this->getData('property') as $property) {
            $i++;
            $ar[$i]['attribute'] = $property->property->name;
            $ar[$i]['format'] = 'text';
            $ar[$i]['label'] = $property->property->name;
            $ar[$i]['value'] = $property->value;
        }

        return $ar;
    }
}