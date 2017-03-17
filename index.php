<?php
use kigl\cef\core\components\ConfigManager;

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL); // E_ALL & ~E_NOTICE

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
define('ROOT_DIR', __DIR__);

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

$baseConfig = require(__DIR__ . '/app/config/web.php');
$coreConfig = require ROOT_DIR . '/packagest/core/config/web.php';
$backendConfig = require ROOT_DIR . '/packagest/backend/config/web.php';
$userConfig = require ROOT_DIR . '/packagest/user/config/web.php';

$app = new yii\web\Application($baseConfig);

$config = Yii::createObject([
    'class' => ConfigManager::class,
    'modulesPath' => '@vendor/kigl',
    'type' => ConfigManager::CONFIG_TYPE_WEB,
]);

