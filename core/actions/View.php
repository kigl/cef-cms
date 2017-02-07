<?php

namespace app\core\actions;
 
 use Yii;
 
 class View extends Action
 {
 	public $view = 'view';
 	
 	public $queryParamName = 'id';

 	public $modelService;

 	public $viewService;
 	
 	public function run()
 	{
        $modelService = new $this->modelService;
        $modelService->setRequestData([
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->view();

        $viewService = new $this->viewService;
        $viewService->setData($modelService->getData());

		return $this->controller->render($this->view, ['data' => $viewService]);
	}
 }
?>