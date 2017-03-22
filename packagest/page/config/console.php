<?php
return [
    'modules' => [
        'page' => [
            'class' => 'kigl\cef\module\page\Module',
            'controllerMap' => [
                'default' => [
                    'class' => 'kigl\cef\core\commands\DefaultController',
                ],
            ],
        ],
    ],
];