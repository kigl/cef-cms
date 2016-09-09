<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use app\modules\informationsystem\models\InformationsystemItem as Item;

class CreateController extends \app\modules\main\components\controllers\BackendController
{
	public $defaultAction = 'system';	
	
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
	
	public function actionItem($informationsystem_id, $group_id = 0)
	{
		$model = new Item;
		
		if ($model->load(Yii::$app->request->post())) {
			$model->informationsystem_id = $informationsystem_id;
			$model->parent_id = $group_id;
			
			if ($model->save()) {
				Yii::$app->session->setFlash('success', Yii::t('main', 'Created element'));
				
				return $this->redirect([
					'backend/manager/item',
					'informationsystem_id' => $informationsystem_id,
					'group_id' => $group_id,
				]);
			}
		}
		
		return $this->render('item', [
				'model' => $model,
				'breadcrumbs' => Item::buildBreadcrumbs($group_id, $informationsystem_id),
				]);

	}
}
