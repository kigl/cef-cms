<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 22.12.2016
 * Time: 21:02
 */

namespace kigl\cef\core\widgets\showContentModal;


class widget extends \yii\base\Widget
{
    public $options = [];

    public function run()
    {
        return $this->render('index', [
            'view' => $this->view,
            'options' => $this->options,
            ]);
    }
}