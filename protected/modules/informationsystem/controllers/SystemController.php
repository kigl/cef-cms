<?php

namespace app\modules\informationsystem\controllers;

use app\modules\informationsystem\models\InformationsystemItem as Item;

class SystemController extends \app\modules\main\components\controllers\FrontendController
{	

	public function actionTest($id)
	{
		echo $id;
	}

	public function actionItem($id)
	{
		$model = Item::getModelItem($id);
		
		print_r($model);
	}
	
	public function actionGroup($group_id)
	{
		$model = Item::getModelItems($group_id);
							
		print_r($model);										
	}
	
	public function actionSystem()
	{
		$model = Item::find()->where('informationsystem_id = :id', [':id' => self::SYSTEM_ID])->all();
		
		print_r($model);
	}
	
}