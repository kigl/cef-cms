<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 28.10.2016
 * Time: 10:25
 */

namespace app\modules\user\controllers;


use yii\data\ActiveDataProvider;
use app\modules\backend\controllers\Controller;
use app\modules\backend\actions\Update;
use app\modules\backend\actions\Create;
use app\modules\backend\actions\Delete;
use app\modules\user\models\backend\Property;

class BackendPropertyController extends Controller
{
    public function actions()
    {
        return [
            'create' => [
                'class' => Create::className(),
                'modelClass' => Property::className(),
            ],
            'update' => [
                'class' => Update::className(),
                'modelClass' => Property::className(),
            ],
            'delete' => [
                'class' => Delete::className(),
                'modelClass' => Property::className(),
            ],
            'sorting' => [
                'class' => \kotchuprik\sortable\actions\Sorting::className(),
                'query' => Property::find(),
                'orderAttribute' => 'sorting',
            ],
        ];
    }

    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Property::find(),
            'sort' => [
                'defaultOrder' => ['sorting' => SORT_ASC],
            ],
        ]);

        return $this->render('manager', [
            'dataProvider' => $dataProvider,
        ]);
    }
}