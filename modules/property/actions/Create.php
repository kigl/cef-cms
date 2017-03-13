<?php
/**
 * Class Create
 * @package app\modules\property\actions
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\property\actions;


use Yii;
use app\modules\property\models\Property;

class Create extends Action
{
    public function run()
    {
        $model = new Property();
        $model->infosystem_id = $this->infosystem_id;
        $model->model_class = $this->modelClass;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect($this->redirect);
        }

        return $this->controller->render($this->view, ['data' => ['model' => $model]]);
    }
}