<?php
/**
 * Class SiteController
 * @package app\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\controllers;


use Yii;
use yii\web\Controller;
use app\modules\infosystem\models\Item;
use yii\web\Response;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $model = Item::find()
            ->where(['infosystem_id' => 'sites', 'name' => 'anomoda.ru'])
            ->one();

       return $this->render('index', ['data' => ['model' => $model]]);
    }

    public function actionSitemap()
    {
        Yii::$app->response->format = Response::FORMAT_XML;

        $links = [];
        foreach (Yii::$app->sitemap->getUrls() as $url) {
            $links[]['link'] = $url;
        }

        return $items = ['some' => 'loop', 'countItems' => count($links), 'data' => $links];
    }
}