<?php

namespace app\modules\backend\controllers;


use Yii;
use yii\filters\AccessControl;

abstract class Controller extends \yii\web\Controller
{
    public $defaultAction = 'index';

    public $layout = '@app/modules/backend/views/layouts/column_2.php';

    public function init()
    {
        parent::init();

        /*
         * Переопределяем точку входа
         * @todo
         * подумать, вынести из контроллера
         */
        Yii::configure(Yii::$app->user, ['loginUrl' => ['/user/backend-login/index']]);
    }

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