<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 05.02.2017
 * Time: 16:04
 */

namespace app\modules\service\controllers\backend;


use app\modules\service\components\BackendController;

class DefaultController extends BackendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}