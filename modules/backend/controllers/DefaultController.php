<?php

namespace app\modules\backend\controllers;

use app\modules\backend\components\Controller;


/**
 * Default controller for the `Main` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index views for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
