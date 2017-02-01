<?php

namespace app\modules\frontend\controllers;


use yii\web\ErrorAction;
use app\modules\frontend\components\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
