<?php

namespace app\widgets\flipBookSlide;


class Widget extends \yii\base\Widget
{
	public $model;

	public function run()
	{
		return $this->render('index', ['data' => ['model' => $this->model]]);
	}
}