<?php

namespace kigl\cef\module\backend\actions;

use Yii;

class Update extends Action
{
	public $returnUrl;

    public $queryParamName = 'id';

	public $view = 'update';

	public $redirect = ['manager']; 
	
	public $scenario = 'default';

	public function run()
	{
		$model = $this->loadModel(Yii::$app->request->getQueryParam($this->queryParamName));
		$model->scenario = $this->scenario;

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			return $this->controller->redirect($this->redirect);
		} else {
			return $this->controller->render($this->view, ['model' => $model]);
		}
	} 
}