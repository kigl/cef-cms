<?php
/**
 * Class BackendFileManager
 * @package app\modules\tool\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\tool\controllers;


use app\modules\backend\controllers\Controller;

class BackendFileManagerController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}