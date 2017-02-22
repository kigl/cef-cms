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

class PropertyController extends BackendController
{
    public function actionCreate($infosystem_id)
    {
        $model = new Property();
        $model->infosystem_id = $infosystem_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        }

        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('_form', ['model' => $model]);
        }

        return $this->render('_form', ['model' => $model]);
    }
}