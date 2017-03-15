<?php
/**
 * Class Widget
 * @package app\modules\shop\widget\frontend\checkedProductProperties
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\widgets\frontend\checkedProductProperties;


class Widget extends \yii\base\Widget
{
    public $model;

    public $propertyId;

    public $radioName = 'radio';

    public function run()
    {
        return $this->render('index', [
                'model' => $this->model,
                'propertyId' => $this->propertyId,
                'radioName' => $this->radioName,
            ]
        );
    }
}