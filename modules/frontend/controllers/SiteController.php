<?php

namespace app\modules\frontend\controllers;


use Yii;
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

    public function actionSitemap()
    {
        header("Content-Type: application/xml");

        if (!$xmlSitemap = Yii::$app->cache->get('sitemap')) {

            $xmlSitemap = $this->renderPartial('sitemap', ['data' => Yii::$app->sitemap]);

            Yii::$app->cache->set('sitemap', $xmlSitemap, 3600 * 12);
        }

        echo $xmlSitemap;
    }
}
