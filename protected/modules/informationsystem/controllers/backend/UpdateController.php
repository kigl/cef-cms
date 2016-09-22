<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use app\modules\informationsystem\models\InformationsystemItem as Item;
use app\modules\informationsystem\models\Tag;

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
			Yii::$app->session->setFlash('success', Yii::t('main', 'Updated element'));
				
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
	
	public function actionTag($id)
	{
		$model = Tag::findOne($id);
		
		if ($model->load(Yii::$app->request->post()) and $model->save()) {
			Yii::$app->session->setFlash('success', Yii::t('main', 'Created element'));
			
			return $this->redirect([
							'backend/manager/tag',
							'informationsystem_id' => $model->informationsystem_id,
						]);				
		}
		
		return $this->render('tag', [
						'model' => $model,
						'informationsytem_id' => $model->informationsystem_id, 	
						'breadcrumbs' => Item::buildBreadcrumbs(null, $model->informationsystem_id),
					]);
	}
}
