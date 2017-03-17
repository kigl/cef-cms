<?php
/**
 * Class PropertyController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\infosystem\controllers\backend;


use Yii;
use yii\helpers\Url;
use kigl\cef\module\infosystem\models\Item;
use kigl\cef\module\property\actions\Create;
use kigl\cef\module\infosystem\components\BackendController;
use kigl\cef\module\infosystem\models\Property;
use kigl\cef\module\infosystem\models\Infosystem;

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