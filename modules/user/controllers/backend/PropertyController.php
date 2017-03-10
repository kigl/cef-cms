<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 28.10.2016
 * Time: 10:25
 */

namespace app\modules\user\controllers\backend;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\user\components\BackendController;
use app\core\actions\Update;
use app\core\actions\Create;
use app\core\actions\Delete;
use app\modules\user\models\Property;

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