<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 06.02.2017
 * Time: 20:06
 */

namespace app\modules\backend\actions;


class EditAttribute extends Action
{
    public $attribute = 'sorting';

    public function run()
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::findOne(\Yii::$app->request->getQueryParam('id'));
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($model->load(\Yii::$app->request->post()) && $model->save(true, [$this->attribute])) {
            return ['output' => $model->{$this->attribute}, 'message' => ''];
        }
    }
}