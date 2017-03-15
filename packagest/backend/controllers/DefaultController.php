<?php

namespace kigl\cef\module\backend\controllers;


use Yii;
use kigl\cef\module\backend\components\Controller;

/**
 * Default controller for the `Main` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index views for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->viewPath = '@kigl/cef/module/backend/views/default';

        return $this->render('index');
    }

    public function actionSetting()
    {
        $class = $this->settingModelClass;

        if (!$model = $class::findOne(1)) {
          $model = new $class;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['default/index']);
        }

        return $this->render('/setting/index', ['data' => ['model' => $model]]);
    }
}
