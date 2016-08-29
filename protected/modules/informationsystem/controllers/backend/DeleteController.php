<?php

namespace app\modules\informationsystem\controllers\backend;

class DeleteController extends \app\modules\main\components\controllers\BackendController
{
	public function actions()
	{
		return [
			'system' => [
				'class' => 'app\modules\main\components\actions\DeleteAction',
				'model'	=> '\app\modules\informationsystem\models\Informationsystem',	
				'redirect' => ['backend/manager/system'],
			],
		];
	}
}