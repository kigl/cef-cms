<?php
namespace app\modules\backend\widgets\actionImage;

class Widget extends \yii\bootstrap\Widget
{
    public $model;

    public $attribute;

    public $behaviorName;

    public function run()
    {
        return $this->render('index', [
            'model' => $this->model,
            'attribute' => $this->attribute,
            'widget' => $this,
        ]);
    }
}
