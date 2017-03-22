<?php
return [
    'modules' => [
        'comment' => [
            'class' => 'kigl\cef\module\comment\Module',
            'controllerMap' => [
                'default' => [
                    'class' => 'kigl\cef\core\commands\DefaultController',
                ],
            ],
        ],
    ],
];