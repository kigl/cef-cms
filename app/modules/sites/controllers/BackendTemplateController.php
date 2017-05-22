<?php
/**
 * Class BackendThemeController
 * @package app\modules\site\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\sites\controllers;


use yii\data\ActiveDataProvider;
use app\modules\backend\actions\Create;
use app\modules\backend\actions\Update;
use app\modules\backend\controllers\Controller;
use app\modules\sites\models\backend\Template;

class BackendTemplateController extends Controller
{
    public function actions()
    {
        return [
            'create' => [
                'class' => Create::className(),
                'modelClass' => Template::className(),
            ],
            'update' => [
                'class' => Update::className(),
                'modelClass' => Template::className(),
            ],
        ];
    }

    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Template::find()
        ]);

        return $this->render('manager', ['data' => ['dataProvider' => $dataProvider]]);
    }

    public function actionListLayout()
    {
        $templateId = '';


    }
}