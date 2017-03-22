<?php

namespace kigl\cef\module\backend\actions;

use Yii;

class Delete extends Action
{
	public $queryParamName = 'id';

	public $redirect = ['manager'];

	public function run()
	{
		$this->loadModel(Yii::$app->request->getQueryParam($this->queryParamName))->delete();

		return $this->controller->redirect($this->redirect);
	}
}
