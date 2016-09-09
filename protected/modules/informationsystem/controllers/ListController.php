<?php

namespace app\modules\informationsystem\controllers\frontend;

use app\modules\informationsystem\models\InformationsystemItem as Item;

class ListController extends \app\modules\main\components\controllers\FrontendController
{
	public function actionItem($informationsystem_id)
	{
		$model = Item::find()
				->where('informationsystem_id = :system_id', [':system_id' => $informationsystem_id])
				->all();
			
		print_r($model);
	}
}