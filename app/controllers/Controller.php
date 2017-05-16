<?php
/**
 * Class Controller
 * @package app\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\controllers;


use Yii;

abstract class Controller extends \app\core\web\Controller
{
    public function beforeAction($action)
    {
        // Временный костыль
        if (Yii::$app->request->hostName != 'anomoda.ru') {
            //$this->redirect('http://anomoda.ru/'. Yii::$app->request->pathInfo, 302);
        }

        return parent::beforeAction($action);
    }
}