<?php
return [
    'modules' => [
        'shop' => [
            'class' => 'kigl\cef\module\shop\Module',
            'controllerMap' => [
                'default' => [
                    'class' => 'kigl\cef\core\commands\DefaultController',
                ],
            ],
        ],
    ],
];