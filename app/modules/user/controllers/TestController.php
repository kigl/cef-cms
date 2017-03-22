<?php
/**
 * Class TestController
 * @package app\modules\user\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\controllers;


use yii\base\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}