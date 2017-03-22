<?php
return [
    'modules' => [
        'service' => [
            'class' => 'kigl\cef\module\service\Module',
            'controllerMap' => [
                'default' => [
                    'class' => 'kigl\cef\core\commands\DefaultController',
                ],
            ],
        ],
    ],
];