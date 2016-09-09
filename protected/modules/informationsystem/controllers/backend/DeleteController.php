<?php

namespace app\modules\informationsystem\controllers\backend;

use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\models\InformationsystemItem as Item;

class DeleteController extends \app\modules\main\components\controllers\BackendController
{
	
	public function actionSystem($id)
	{	
		if ($modelSystem = System::findOne($id)) {
			$modelItem = Item::findAll(['informationsystem_id' => $modelSystem->id]);
			foreach ($modelItem as $item) {
				$item->delete();
			}
			$modelSystem->delete();
			
			return $this->redirect(['backend/manager/system']);
		}
	}
	
	public function actionItem($id)
	{
		$model = Item::findOne($id);
		
		if ($model) {
			$parentModel = Item::findAll(['parent_id' => $model->id]);
			
			foreach ($parentModel as $subModel) {
				$subModel->delete();
			}
		}
		
		$model->delete();
		
		return $this->redirect([
				'backend/manager/item',
				'informationsystem_id' => $model->informationsystem_id,
				'group_id' => $model->parent_id,
		]);
	}
}