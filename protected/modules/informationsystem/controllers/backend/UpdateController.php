<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use app\modules\informationsystem\models\InformationsystemItem as Item;

class UpdateController extends \app\modules\main\components\controllers\BackendController
{
	public $defaultAction = 'system';
	
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
	
	public function actionItem($id)
	{
		$model = Item::findOne($id);
		
		if ($model->load(Yii::$app->request->post()) and $model->save()) {			
			return $this->redirect([
				'backend/manager/item',
				'informationsystem_id' => $model->informationsystem_id,
				'group_id' => $model->parent_id,
			]);
		}
		
		return $this->render('item', [
				'model' => $model,
				'breadcrumbs' => Item::buildBreadcrumbs($model->id, $model->informationsystem_id),
			]);
	}	
}
