<?php

namespace app\modules\main\widgets\backend\imageInForm;

use Yii\helpers\Html;

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
