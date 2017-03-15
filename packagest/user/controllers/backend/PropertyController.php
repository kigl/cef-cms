<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 28.10.2016
 * Time: 10:25
 */

namespace kigl\cef\module\user\controllers\backend;


use Yii;
use yii\data\ActiveDataProvider;
use kigl\cef\module\user\components\BackendController;
use kigl\cef\module\backend\actions\Update;
use kigl\cef\module\backend\actions\Create;
use kigl\cef\module\backend\Delete;
use kigl\cef\module\user\models\Property;

class PropertyController extends BackendController
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