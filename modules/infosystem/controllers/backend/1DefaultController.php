<?php
/**
 * Class DefaultController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers\backend;


use app\modules\infosystem\components\BackendController;

class DefaultController extends BackendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}