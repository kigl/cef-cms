<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 06.02.2017
 * Time: 20:06
 */

namespace app\core\actions;


class EditAttributeModel extends Action
{
    public $modelClass;

    public $queryParams;

    public $postData;

    public $attribute;

    public function run()
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::findOne($this->queryParams['id']);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($model->load(\Yii::$app->request->post()) && $model->save(true, [$this->attribute])) {
            return ['output' => $model->position, 'message' => ''];
        }
    }
}