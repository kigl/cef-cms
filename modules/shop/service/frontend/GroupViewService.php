<?php
/**
 * Class GroupViewService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;

use yii\helpers\Html;
use app\core\service\ViewService;

class GroupViewService extends ViewService
{
    public function getId()
    {
        $data = $this->getData('model');

        return $data->id;
    }

    public function getName()
    {
        $data = $this->getData('model');

        return $data->name;
    }

    public function getMetaDescription()
    {
        $data = $this->getData('model');

        return $data->meta_description;
    }

    public  function getDataProvider()
    {
        $data = $this->getData('dataProvider');

        return $data;
    }
}