<?php

namespace app\modules\informationsystem\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use app\modules\informationsystem\models\InformationsystemItem as Item;
use app\modules\informationsystem\models\Informationsystem as System;

abstract class FrontentControllerAbstract extends \app\modules\main\components\controllers\FrontendController
{
	public $systemId;


	
	public function actionManager($group_id = 0)
	{
		$dataProvider = new ActiveDataProvider([
													'query' => Item::find()
																			->where('informationsystem_id = :systemId', [':systemId' => $this->systemId])
																			->andWhere('parent_id = :group_id', [':group_id' => $group_id])
																			->orderBy('item_type ASC'),
													'sort' => [
														'defaultOrder' => [
															'create_time' => SORT_DESC,
														],
													],
													'pagination' => [
														'pageSize' => 12,
													],
		]);
		
		return $this->render('manager', [
						'dataProvider' => $dataProvider,
						'group_id' => $group_id,
						'breadcrumbs' => static::buildBreadcrumbs($group_id, $this->systemId),
					]);
	}
	
	public function actionView($id)
	{
		$model = Item::findOne($id);
		
		return $this->render('view', [
						'model' => $model,
						'breadcrumbs' => static::buildBreadcrumbs($model->id, $this->systemId),	
					]);
	}
	
	public function actionCreate($group_id = 0)
	{
		$model = new Item;
		
		if ($model->load(Yii::$app->request->post()) and $model->save()) {
			Yii::$app->session->setFlash('success', Yii::t('main', 'Created element'));
			
			return $this->redirect(['manager', 'group_id' => $group_id]);	
		}
		
		return $this->render('create', [
						'model' => $model,
						'group_id' => $group_id,
						'breadcrumbs' => static::buildBreadcrumbs($group_id, $this->systemId),
					]);
	}
		
	public function actionUpdate($id)
	{
		$model = Item::findOne($id);
		
		if ($model->load(Yii::$app->request->post()) and $model->save()) {
			Yii::$app->session->setFlash('success', Yii::t('main', 'Updated element'));
			
			return $this->redirect(['manager', 'group_id' => $model->parent_id]);	
		}
		
		return $this->render('update', [
						'model' => $model,
						'group_id' => $model->parent_id,
						'breadcrumbs' => static::buildBreadcrumbs($model->id, $this->systemId),
					]);
	}		

	/**
	* Рекурсивная функция для построение массива
	* @param integer $id
	* 
	* @return array | false
	*/
	protected static function recursive($id)
	{
		$model = Item::find()
				->select(['id', 'parent_id', 'name', 'informationsystem_id'])
				->where('id = :id', [':id' => $id])
				->asArray()
				->one();
		
		if ($model) {
			$result =	self::recursive($model['parent_id']);
			
			$result[] = [
					'id' => $model['id'],
					'parent_id' => $model['parent_id'],
					'name' => $model['name'],
					'informationsystem_id' => $model['informationsystem_id'],
					];
		}
		
		return (!empty($result))? $result : false;
	}		
}
