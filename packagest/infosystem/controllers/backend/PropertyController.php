<?php
/**
 * Class PropertyController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers\backend;


use Yii;
use yii\helpers\Url;
use app\modules\infosystem\models\Item;
use app\modules\property\actions\Create;
use app\modules\infosystem\components\BackendController;
use app\modules\property\models\Property;
use app\modules\infosystem\models\Infosystem;

class PropertyController extends BackendController
{

    public function actions()
    {
        return [
            'sorting' => [
                'class' => \kotchuprik\sortable\actions\Sorting::className(),
                'query' => Property::find(),
                'orderAttribute' => 'sorting',
            ],
            'create' => [
                'class' => Create::className(),
                'modelClass' => Item::className(),
                'infosystem_id' => Yii::$app->request->getQueryParam('infosystem_id'),
                'view' => 'create',
                'redirect' => Url::to(['infosystem/update', 'id' => Yii::$app->request->getQueryParam('infosystem_id')]),
            ],
        ];
    }
/*
    public function actionCreate($infosystem_id)
    {
        $model = new Property([
            'infosystem_id' => $infosystem_id,
            'model_class' => Item::class,
        ]);
        $infosystem = Infosystem::findOne($infosystem_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['infosystem/update', 'id' => $model->infosystem_id]);
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
            return $this->redirect(['infosystem/update', 'id' => $model->infosystem_id]);
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
            return $this->redirect(['infosystem/update', 'id' => $model->infosystem_id]);
        }
    }
*/
}