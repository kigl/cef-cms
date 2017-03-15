<?php

namespace kigl\cef\module\backend\widgets\imageFormSUD;


class Widget extends \yii\base\Widget
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

