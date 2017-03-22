<?php

namespace kigl\cef\module\backend\actions;

use yii\web\NotFoundHttpException;

abstract class Action extends \yii\base\Action
{
    public $modelClass;

    public $view = 'index';

    protected function loadModel($queryId)
    {
        $model = $this->modelClass;

        if (($model = $model::findOne($queryId)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
} 