<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require "../../../core/vendor/autoload.php";
require "../../../core/vendor/yiisoft/yii2/Yii.php";

$config = require "config/config.php";
new \yii\web\Application($config);

require 'views/index.php';
?>


