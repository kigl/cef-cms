<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use app\modules\informationsystem\models\InformationsystemItem as Item;
use app\modules\informationsystem\models\InformationsystemGroup as Group;

class CreateController extends \app\modules\main\components\controllers\BackendController
{
	public function actions()
	{
		return [
			'system' => [
				'class' => 'app\modules\main\components\actions\CreateAction',
				'model'	=> '\app\modules\informationsystem\models\Informationsystem',
				'view' => 'system',		
				'redirect' => ['backend/manager/system'],
			],
		];
	}
	
	public function actionItem($informationsystem_id, $type)
	{
		$model = new Item;
		
		if ($model->load(Yii::$app->request->post()) and $model->save()) {
			return $this->redirect([
				'backend/manager/item',
				'informationsystem_id' => $informationsystem_id,
			]);
		}
		
		if ($type == 'item') {
			return $this->render('item', ['model' => $model]);
		} elseif ($type == 'group') {
			return $this->render('group', ['model' => $model]);
		}
	}
	
	public function actionGroup($informationsystem_id, $group_id)
	{
		$model = new Group;
		if ($model->load(Yii::$app->request->post()) and $model->save()) {
			return $this->redirect([
					'backend/manager/group',
					'informationsystem_id' => $informationsystem_id,
					'group_id' => $model->id,
			]);
		}
		
		return $this->render('group', ['model' => $model]);
	}
}
