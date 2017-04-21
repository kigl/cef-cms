<?php
require(__DIR__ . '../../../../vendor/autoload.php');
require(__DIR__ . '../../../../vendor/yiisoft/yii2/Yii.php');

$config = \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '../../../../app/config/console.php'),
    require './config/config.php'
);

$app = new yii\web\Application($config);