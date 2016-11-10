<?php

namespace app\controllers;

use app\core\controllers\FrontendController;

class SiteController extends FrontendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionError()
    {
        return $this->render('error');
    }
		
}