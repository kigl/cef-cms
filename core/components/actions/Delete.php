<?php

namespace app\core\components\actions;

use Yii;

class Delete extends Action
{
	public $getQuery = 'id';

	public $redirect = ['manager'];

	public function run()
	{
		$this->loadModel(Yii::$app->request->getQueryParam($this->getQuery))->delete();

		return $this->controller->redirect($this->redirect);
	}
}
