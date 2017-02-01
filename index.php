<?php

use app\core\components\configManager\ConfigManager;
use app\core\components\configManager\ConfigWeb;

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL); // E_ALL & ~E_NOTICE

if (!ini_get('date.timezone')) {
    date_default_timezone_set('Europe/Moscow');
}

// Setting internal encoding to UTF-8.
if (!ini_get('mbstring.internal_encoding')) {
    @ini_set("mbstring.internal_encoding", 'UTF-8');
    mb_internal_encoding('UTF-8');
}

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/core/vendor/autoload.php');
require(__DIR__ . '/core/vendor/yiisoft/yii2/Yii.php');

// основная конфигурация
$baseConfig = require(__DIR__ . '/core/config/web.php');

// менеджер конфигураций
$config = Yii::createObject([
    'class' => ConfigManager::className(),
    'modulesPath' => Yii::getAlias('@app' . '/modules'),
], [$baseConfig, new ConfigWeb]);

(new yii\web\Application($config->getConfig()))->run();

