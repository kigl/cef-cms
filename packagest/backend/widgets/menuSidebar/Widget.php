<?php

namespace kigl\cef\module\backend\widgets\menuSidebar;


use Yii;
use app\core\components\ConfigManager;

class Widget extends \yii\base\Widget
{
    public function run()
    {

        return $this->render('index', [
            'data' => []//Yii::$app->configManager->getConfig()['menu'],
        ]);
    }
}