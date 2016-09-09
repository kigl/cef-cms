<?php

namespace app\modules\main\controllers\backend;

use yii\base\Module;

/**
 * Default controller for the `Main` module
 */
class DefaultController extends \app\modules\main\components\controllers\BackendController
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
