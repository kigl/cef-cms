<?php

namespace app\modules\main\components\controllers;

use yii\filters\AccessControl;

abstract class BackendController extends \yii\web\Controller
{
	public $layout = '@app/modules/main/views/backend/layouts/column_2';
	
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