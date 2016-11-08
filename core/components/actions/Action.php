<?php

namespace app\core\components\actions;

use yii\web\NotFoundHttpException;

abstract class Action extends \yii\base\Action
{
    public $model;

    public $view = 'index';

    protected function loadModel($getQuery)
    {
        $model = $this->model;

        if (($model = $model::findOne($getQuery)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
} 