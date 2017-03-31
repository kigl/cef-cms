<?php
Yii::setAlias('@webroot', ROOT_DIR);

$config = [
    'id' => 'main2-console',
    'basePath' => dirname(__DIR__),

    'vendorPath' => '@webroot/vendor',

    'components' => [
        'db' => require(__DIR__ . '/db.php'),

    ],
];

return $config;
