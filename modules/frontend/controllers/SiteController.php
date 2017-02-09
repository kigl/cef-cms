<?php

namespace app\modules\frontend\controllers;


use yii\web\ErrorAction;
use yii\captcha\CaptchaAction;
use app\modules\frontend\components\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
            ],
            'captcha' => [
                'class' => CaptchaAction::className(),
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
