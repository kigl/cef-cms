<?php
/**
 * Class PropertyController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\infosystems\models\backend\Property;
use app\modules\infosystems\models\backend\Infosystem;

class BackendPropertyController extends Controller
{

    public function actions()
    {
        return [
            'sorting' => [
                'class' => \kotchuprik\sortable\actions\Sorting::className(),
                'query' => Property::find(),
                'orderAttribute' => 'sorting',
            ],
        ];
    }

    public function actionCreate($infosystem_id)
    {
        $model = new Property([
            'infosystem_id' => $infosystem_id,
        ]);

        $infosystem = Infosystem::findOne($infosystem_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['backend-infosystem/update', 'id' => $model->infosystem_id]);
        }

        return $this->render('create', [
            'data' => [
                'model' => $model,
                'infosystem' => $infosystem,
            ]
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Property::find()
            ->where(['id' => $id])
            ->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['backend-infosystem/update', 'id' => $model->infosystem_id]);
        }

        return $this->render('update', [
            'data' => [
                'model' => $model,
                'infosystem' => $model->infosystem,
            ]
        ]);
    }

    public function actionDelete($id)
    {
        $model = Property::findOne($id);

        if ($model->delete()) {
            return $this->redirect(['backend-infosystem/update', 'id' => $model->infosystem_id]);
        }
    }

    public function actionSelectionDelete()
    {
        if ($keys = Yii::$app->request->post('selection')) {
            Property::deleteAll(['in', 'id', $keys]);
        }
    }
}