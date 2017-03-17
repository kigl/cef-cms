<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 26.10.2016
 * Time: 18:01
 */

namespace kigl\cef\module\shop\controllers\backend;

use yii\data\ActiveDataProvider;
use kigl\cef\module\shop\components\BackendController;
use kigl\cef\module\shop\models\Property;

class PropertyController extends BackendController
{
    public function actions()
    {
        return [
            'create' => [
                'class' => 'app\core\actions\Create',
                'modelClass' => Property::className(),
            ],
            'update' => [
                'class' => 'app\core\actions\Update',
                'modelClass' => Property::className(),
            ],
        ];
    }

    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Property::find(),
        ]);

        return $this->render('manager', ['dataProvider' => $dataProvider]);
    }
}