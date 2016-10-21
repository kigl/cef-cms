<?php

namespace app\modules\admin\controllers;

use yii\base\Module;

/**
 * Default controller for the `Main` module
 */
class DefaultController extends \app\modules\admin\components\controllers\BackendController
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
