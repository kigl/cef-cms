<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 03.03.2017
 * Time: 23:07
 */

namespace kigl\cef\module\backend\widgets\toolbar;


use Yii;
use yii\widgets\Menu;

class Widget extends \yii\base\Widget
{
    public $options = [];

    public function run()
    {
        $config = [];//Yii::$app->configManager->getConfig()['toolbar'];

        if ($items = Yii::$app->controller->module->toolbar) {
            echo Menu::widget([
                'options' => $this->options,
                'encodeLabels' => false,
                'linkTemplate' => '<a href="{url}" class="btn btn-default btn-sm">{label}</a>',
                'items' => $items,
            ]);
        }
    }
}