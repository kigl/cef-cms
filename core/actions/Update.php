<?php

namespace app\core\actions;

use Yii;

class Update extends Action
{
	public $returUrl;

	public $queryParam = 'id';

	public $view = 'update';

	public $redirect = ['manager']; 
	
	public $scenario = 'default';

	public function run()
	{
		$model = $this->loadModel(Yii::$app->request->getQueryParam($this->queryParam));
		$model->scenario = $this->scenario;

		if ($model->load(Yii::$app->request->post()) and $model->save()) {
			
			return $this->controller->redirect($this->redirect);
		} else {
			return $this->controller->render($this->view, ['model' => $model]);
		}
	} 
}