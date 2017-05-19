<?php
/**
 * Class BackendSiteController
 * @package app\modules\site\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\site\controllers;


use app\modules\backend\actions\Create;
use app\modules\backend\actions\Update;
use yii\data\ActiveDataProvider;
use app\modules\site\models\backend\Site;
use app\modules\backend\controllers\Controller;

class BackendSiteController extends Controller
{
    public function actions()
    {
        return [
            'create' => [
                'class' => Create::className(),
                'modelClass' => Site::className(),
            ],
            'update' => [
                'class' => Update::className(),
                'modelClass' => Site::className(),
            ],
        ];
    }

    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Site::find(),
        ]);

        return $this->render('manager', ['data' => ['dataProvider' => $dataProvider]]);
    }
}