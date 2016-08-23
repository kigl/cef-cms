<?php

namespace app\modules\main\components\controllers;

use Yii;

abstract class FrontendController extends \yii\web\Controller 
{
	public $defaultAction = 'index';
		
	public function getViewPath()
	{
		if ($this->module->id != 'basic') {
	 		$path = Yii::$app->view->theme->basePath . DIRECTORY_SEPARATOR . $this->module->id;			
		} else {
			$path = parent::getViewPath();
		}

    return $path;
	}
}