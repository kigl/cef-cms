<?php

namespace app\modules\main\components\actions;

use Yii;

class DeleteAction extends \app\modules\main\components\action
{
	public $getQuery = 'id';

	public $redirect = ['manager'];

	public function run()
	{
		$this->loadModel(Yii::$app->request->getQueryParam($this->getQuery))->delete();

		return $this->controller->redirect($this->redirect);
	}
}
