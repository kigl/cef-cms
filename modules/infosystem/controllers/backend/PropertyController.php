<?php
/**
 * Class PropertyController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers\backend;


use Yii;
use app\modules\infosystem\components\BackendController;
use app\modules\infosystem\models\Property;
use app\modules\infosystem\models\Infosystem;

class PropertyController extends BackendController
{

    public function actionCreate($infosystem_id)
    {
        $model = new Property();
        $model->infosystem_id = $infosystem_id;
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
            ->with('infosystem')
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
}