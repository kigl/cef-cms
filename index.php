<?php

use app\core\components\ConfigManager;

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL); // E_ALL & ~E_NOTICE

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/core/vendor/autoload.php');
require(__DIR__ . '/core/vendor/yiisoft/yii2/Yii.php');

// основная конфигурация
$baseConfig = require(__DIR__ . '/core/config/web.php');

// менеджер конфигураций
$config = Yii::createObject([
    'class' => ConfigManager::class,
    'modulesPath' => '@app/modules',
    'type' => ConfigManager::CONFIG_TYPE_WEB,
]);

(new yii\web\Application(
    array_merge_recursive($config->getConfig(), $baseConfig)
))->run();
