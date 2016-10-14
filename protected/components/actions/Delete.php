<?php

namespace app\components\actions;

use Yii;

class Delete extends Action
{
	public $getQuery = 'id';

	public $redirect = ['manager'];

	public function run()
	{
		$this->loadModel(Yii::$app->request->getQueryParam($this->getQuery))->delete();
				Yii::$app->session->setFlash('success', Yii::t('main', 'deleted element'));
		return $this->controller->redirect($this->redirect);
	}
}
