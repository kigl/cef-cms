<?php

namespace kigl\cef\module\backend\actions;

use Yii;

class Create extends Action
{
	public $view = 'create';

	public $redirect = ['manager'];
	
	public $scenario = 'default';

	public function run()
	{
		$model = new $this->modelClass;
		$model->scenario = $this->scenario;

		if($model->load(Yii::$app->request->post()) and $model->save()) {
			
			return $this->controller->redirect($this->redirect);
		} else {
			return $this->controller->render($this->view, [
			    'model' => $model,
            ]);
		}
	}
}