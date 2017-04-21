<?php
return [
    //'controllerNamespace' => 'app\packagest\user\commands',
    'controllerNamespace' => 'app\commands',
    //'defaultRoute' => 'rbac/index',

    'components' => [
        'db' => [
            'dsn' => 'sqlite:' . __DIR__. './../data/test.db',
            'username' => '',
            'password' => '',
        ],
    ],
];