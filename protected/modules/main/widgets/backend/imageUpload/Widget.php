<?php

namespace app\modules\main\widgets\backend\imageUpload;

class Widget extends \yii\base\Widget
{
	public $model;
	
	public $attribute;
	
	public $formInstance;
	
	public function run()
	{
		return $this->render('index', [
						'model' => $this->model,
						'attribute' => $this->attribute,
						'form' => $this->formInstance,
		]);
	}
}

?>