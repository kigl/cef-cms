<?php
/**
 * Class SiteController
 * @package app\modules\form\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\forms\controllers;


use yii\captcha\CaptchaAction;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => CaptchaAction::className()
            ],
        ];
    }
}