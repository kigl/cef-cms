<?php

namespace app\modules\backend\widgets;


use Yii;
use yii\widgets\Menu as YiiMenu;

class Menu extends \yii\widgets\Menu
{
    public function run()
    {
        $this->items = Yii::$app->getModule('backend')->menuItems;

        parent::run();
    }
}