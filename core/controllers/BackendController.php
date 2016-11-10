<?php

namespace app\core\controllers;

use yii\filters\AccessControl;

/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 10.11.2016
 * Time: 17:40
 */
abstract class BackendController extends \yii\web\Controller
{
    public $layout = '@app/modules/admin/views/layouts/column_2';

    public $defaultAction = 'manager';

    public function behaviors()
    {
        return [
            'accessControl' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                        //'ips' => ['127.0.0.1'],
                    ],
                ],
            ],
        ];
    }
}