<?php

namespace app\modules\admin\components;

use yii\filters\AccessControl;

abstract class Controller extends \yii\web\Controller
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