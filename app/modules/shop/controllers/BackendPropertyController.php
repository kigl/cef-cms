<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 26.10.2016
 * Time: 18:01
 */

namespace app\modules\shop\controllers;


use yii\data\ActiveDataProvider;
use app\modules\backend\controllers\Controller;
use app\modules\shop\models\backend\Property;

class BackendPropertyController extends Controller
{
    public function actions()
    {
        return [
            'create' => [
                'class' => 'app\modules\backend\actions\Create',
                'modelClass' => Property::className(),
            ],
            'update' => [
                'class' => 'app\modules\backend\actions\Update',
                'modelClass' => Property::className(),
            ],
            'delete' => [
                'class' => 'app\modules\backend\actions\Delete',
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

        return $this->render('manager', ['dataProvider' => $dataProvider]);
    }
}