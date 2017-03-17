<?php

namespace kigl\cef\module\backend\components;

use yii\filters\AccessControl;

abstract class Controller extends \yii\web\Controller
{
    public $defaultAction = 'index';

    public function behaviors()
    {
        return [
            /*'accessControl' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'manager'],
                        //'ips' => ['127.0.0.1'],
                    ],
                ],
            ],*/
        ];
    }
}