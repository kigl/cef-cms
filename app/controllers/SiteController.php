<?php
/**
 * Class SiteController
 * @package app\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\controllers;


use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {

        return $this->render('index');
    }
}