<?php

namespace app\modules\backend\controllers;


use Yii;

/**
 * Default controller for the `Main` module
 */
class BackendDefaultController extends Controller
{
    /**
     * Renders the index views for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->viewPath = '@app/modules/backend/views/backend-default';

        return $this->render('index');
    }
}
