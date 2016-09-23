<?php

namespace app\modules\main\components\actions;
 
 use Yii;
 
 class ViewAction extends \app\modules\main\components\Action
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