<?php

namespace app\modules\frontend\controllers;

use app\modules\frontend\components\Controller;

class SiteController extends Controller
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
