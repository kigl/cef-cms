<?php
/**
 * Class LoopController
 * @package app\modules\test\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\kill\test\controllers;


use yii\web\Controller;

class LoopController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}