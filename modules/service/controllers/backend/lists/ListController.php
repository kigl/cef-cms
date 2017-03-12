<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 12.03.2017
 * Time: 19:25
 */

namespace app\modules\service\controllers\backend\lists;


use app\core\actions\Create;
use app\modules\service\components\BackendController;
use app\modules\service\models\lists\Lists;
use yii\data\ActiveDataProvider;

class ListController extends BackendController
{
    public function actions()
    {
        return [
            'create' => [
                'class' => Create::className(),
                'modelClass' => Lists::className(),
            ],
            'update' => [
                'class' => Create::className(),
                'modelClass' => Lists::className(),
            ],
        ];
    }

    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Lists::find(),
        ]);

        return $this->render('manager', ['data' => [
            'dataProvider' => $dataProvider,
        ]]);
    }
}