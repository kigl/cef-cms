<?php

namespace app\modules\backend\actions;
 
 use Yii;
 
 class View extends Action
 {
 	public $view = 'view';
 	
 	public $queryParamName = 'id';
 	
 	public function run()
 	{
        $model = $this->loadModel(Yii::$app->request->getQueryParam($this->queryParamName));

        if (Yii::$app->request->isAjax) {
            return $this->controller->renderAjax($this->view, ['data' => ['model' => $model]]);
        }

        return $this->controller->render($this->view, ['data' => ['model' => $model]]);
	}
 }
?>