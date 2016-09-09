<?php

namespace app\modules\main\components\controllers;


abstract class BackendController extends \yii\web\Controller
{
	public $layout = '@app/modules/main/views/backend/layouts/index';
	
  public $defaultAction = 'manager';
}