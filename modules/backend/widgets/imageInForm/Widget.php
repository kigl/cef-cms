<?php

namespace app\modules\backend\widgets\imageInForm;


class Widget extends \yii\base\Widget
{
	public $model;
	
	public $attribute;
		
	public function run()
	{	
		return $this->render('index', [
						'model' => $this->model,
						'attribute' => $this->attribute,
		]);
	}
}
