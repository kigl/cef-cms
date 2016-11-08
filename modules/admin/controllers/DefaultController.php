<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\BackendController;

/**
 * Default controller for the `Main` module
 */
class DefaultController extends BackendController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
