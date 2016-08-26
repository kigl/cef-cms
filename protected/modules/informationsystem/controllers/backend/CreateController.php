<?php

namespace app\modules\informationsystem\controllers\backend;

class CreateController extends \app\modules\main\components\controllers\BackendController
{
	public function actions()
	{
		return [
			'system' => [
				'class' => 'app\modules\main\components\actions\CreateAction',
				'model'	=> '\app\modules\informationsystem\models\Informationsystem',
				'view' => 'informationsystem',		
			],
		];
	}
	
	public function actionDefault()
	{
		echo 123;
	}
}