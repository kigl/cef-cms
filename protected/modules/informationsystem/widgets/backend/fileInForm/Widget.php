<?php
namespace app\modules\informationsystem\widgets\backend\fileInForm;

class Widget extends \yii\base\Widget
{
	public $model;
	
	public $deleteKey;
	
	public $behaviorName;
	
	public $formInstance;
	
	public function run()
	{
		return $this->render('index', [
						'model' => $this->model,
						'deleteKey' => $this->deleteKey,
						'behaviorName' => $this->behaviorName,
						'form' => $this->formInstance,
		]);
	}
}
?>