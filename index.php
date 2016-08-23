<?php
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

define('ROOT_DIR', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/protected/vendor/autoload.php');
require(__DIR__ . '/protected/vendor/yiisoft/yii2/Yii.php');
// менеджер конфигураций
require(__DIR__ . '/protected/modules/main/components/ConfigManager.php');

// основная конфигурация
$baseConfig = require(__DIR__ . '/protected/config/web.php');

$config = (new ConfigManager($baseConfig))->getConfig();

(new yii\web\Application($config))->run();
