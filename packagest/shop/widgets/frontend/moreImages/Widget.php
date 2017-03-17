<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 16.12.2016
 * Time: 21:42
 */

namespace kigl\cef\module\shop\widgets\frontend\moreImages;


class Widget extends \yii\base\Widget
{
    public $model;

    public function run()
    {
        return $this->render('index', ['model' => $this->model]);
    }
}