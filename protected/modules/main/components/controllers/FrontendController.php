<?php

namespace app\modules\main\components\controllers;

use Yii;

abstract class FrontendController extends \yii\web\Controller 
{
		
	public $layout = '@app/modules/main/views/layouts/column_2';
		
	public function getViewPath()
	{
		/*
		if ($this->module->id != 'basic') {
	 		$path = Yii::$app->view->theme->basePath . DIRECTORY_SEPARATOR . $this->module->id;			
		} else {
			$path = parent::getViewPath();
		}
		

    return $path;
    */
    return parent::getViewPath();
	}
}