<?php

namespace app\modules\backend\components;

use yii\filters\AccessControl;

abstract class Controller extends \yii\web\Controller
{
    public $defaultAction = 'index';

    public $settingModelClass;

    public function behaviors()
    {
        return [
            'accessControl' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'manager'],
                        //'ips' => ['127.0.0.1'],
                    ],
                ],
            ],
        ];
    }
}