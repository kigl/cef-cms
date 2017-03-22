<?php
return [
    'modules' => [
        'infosystem' => [
            'class' => 'kigl\cef\module\infosystem\Module',
            'controllerMap' => [
                'default' => [
                    'class' => 'kigl\cef\core\commands\DefaultController',
                ],
            ],
        ],
    ],
];