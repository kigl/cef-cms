<?php

namespace app\components\actions;
 
 use Yii;
 
 class View extends Action
 {
 	public $view = 'view';
 	
 	public $queryParam = 'id';
 	
 	public function run()
 	{
		$model = $this->loadModel(Yii::$app->request->getQueryParam($this->queryParam));

		return $this->controller->renderPartial($this->view, ['model' => $model]);	
	}
 }
?>