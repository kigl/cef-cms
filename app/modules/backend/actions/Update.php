<?php

namespace app\modules\backend\actions;

use Yii;

class Update extends Action
{
    public $returnUrl;

    public $queryParamName = 'id';

    public $view = 'update';

    public $viewAjax = '_form';

    public $redirect = ['manager'];

    public $scenario = 'default';

    public function run()
    {
        $model = $this->loadModel(Yii::$app->request->getQueryParam($this->queryParamName));
        $model->scenario = $this->scenario;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->controller->redirect($this->redirect);
        }

        if (Yii::$app->request->isAjax) {
            return $this->controller->renderAjax($this->viewAjax, ['model' => $model]);
        }

        return $this->controller->render($this->view, ['model' => $model]);

    }
}