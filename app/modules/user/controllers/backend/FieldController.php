<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 28.10.2016
 * Time: 10:25
 */

namespace app\modules\user\controllers\backend;


use yii\data\ActiveDataProvider;
use app\modules\admin\components\controllers\BackendController;
use app\components\actions\Update;
use app\components\actions\Create;
use app\components\actions\Delete;
use app\modules\user\models\Field;

class FieldController extends BackendController
{
    public function actions()
    {
        return [
            'create' => [
                'class' => Create::className(),
                'model' => Field::className(),
            ],
            'update' => [
                'class' => Update::className(),
                'model' => Field::className(),
            ],
            'delete' => [
                'class' => Delete::className(),
                'model' => Field::className(),
            ],
        ];
    }

    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Field::find(),
        ]);

        return $this->render('manager', [
            'dataProvider' => $dataProvider,
        ]);
    }
}