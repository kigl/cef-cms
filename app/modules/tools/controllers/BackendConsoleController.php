<?php
/**
 * Class BackendConsoleController
 * @package app\modules\tool\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\tools\controllers;


use app\modules\backend\controllers\Controller;

class BackendConsoleController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionConsole()
    {
        return $this->renderFile('@app/modules/tools/components/console.php');
    }
}