<?php
return [
    'id' => 'coupon',
    'basePath' => dirname(__DIR__),
    //'vendorPath' => '/core/vendor',

    'language' => 'ru-RU',

    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=main2',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'mn_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
    ],
];
?>