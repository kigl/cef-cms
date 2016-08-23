<?php

namespace app\controllers;

use Yii;

class SiteController extends \app\modules\main\components\controllers\FrontendController
{
    public function actionIndex()
    {
			return $this->render('index'); 
    }
    
    public function actionError()
    {
			return $this->render('error');
		}
		
		public function actionInit()
		{

		}
}