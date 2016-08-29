<?php

namespace app\modules\informationsystem\controllers\backend;

class UpdateController extends \app\modules\main\components\controllers\BackendController
{
	public function actions()
	{
		return [
			'system' => [
				'class' => 'app\modules\main\components\actions\UpdateAction',
				'model' => '\app\modules\informationsystem\models\Informationsystem',
				'view' => 'system',
				'redirect' => ['backend/manager/system'],
			],
		];
	}	
}
