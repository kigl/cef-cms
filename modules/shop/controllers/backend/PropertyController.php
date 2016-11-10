<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 26.10.2016
 * Time: 18:01
 */

namespace app\modules\shop\controllers\backend;

use yii\data\ActiveDataProvider;
use app\modules\shop\components\Controller;
use app\modules\shop\models\Property;

class PropertyController extends Controller
{
    public function actions()
    {
        return [
            'create' => [
                'class' => 'app\core\actions\Create',
                'model' => Property::className(),
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