<?php

namespace app\modules\main\components\controllers;

use yii\filters\AccessControl;
use app\modules\user\models\User;

abstract class BackendController extends \yii\web\Controller
{
    public $defaultAction = 'manager';

    public $layout = '@app/modules/main/views/backend/layouts/index';

    public function behaviors()
    {
      return [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
            		[
            			'allow' => true,
            			'actions' => ['index', 'manager'],
            			'roles' => ['manager'],
            		],
            		[
            			'allow' => true,
            			'actions' => ['create'],
            			'roles' => ['create'],
            		],
            		[
            			'allow' => true,
            			'actions' => ['update'],
            			'roles' => ['update'],
            		],
            		[
            			'allow' => true,
            			'actions' => ['delete'],
            			'roles' => ['delete'],
            		],
            		[
            			'allow' => true,
            			'roles' => ['admin'],
            		],
            ],
        ],
      ];
    }
}