<?php

namespace app\modules\forum\controllers;

use Yii;
use yii\filters\AccessControl;
use app\modules\forum\models\Topic;

abstract class FrontendControllerAbstract extends \app\modules\main\components\controllers\FrontendController
{
	public function behaviors()
	{
		return [
			'accessControl' => [		
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'actions' => ['manager', 'view', 'index'],
						'roles' => ['guest'],
					],
					[
						'allow' => true,
						'actions' => ['update', 'create'],
						'roles' => ['register'],
					],
				],
			],
		];
	}
	
	/**
	*	Строит путь с вложениями для виджета Breadcrumbs
	* @param integer $id
	* 
	* @return array | false
	*/
	public static function buildBreadcrumbs($id = null)
	{
		$result[] = [
			'label' => Yii::$app->controller->module->getName(),
			'url' => ['default/index'],
		];
		
		if ($id !== null and $breadcrumbs = self::recursive($id)) {
			$c = count($breadcrumbs) - 1;
			$breadcrumbs[$c]['span'] = 1;
			
			foreach ($breadcrumbs as $model)
			{
				if (!isset($model['span'])) {
					$result[] = [
							'label' => $model['name'],
							'url' => [
								'topic/manager',
								'parentId' => $model['id'],
							]
					];		
				} else {
					$result[] = ['label' => $model['name']];				
				}
			}
		}


		
		return (!empty($result))? $result : null;
	}
	
	/**
	* Рекурсивная функция для построение массива
	* @param integer $id
	* 
	* @return array | false
	*/
	protected static function recursive($id)
	{
		$model = Topic::find()
				->select(['id', 'parent_id', 'name'])
				->where('id = :id', [':id' => $id])
				->asArray()
				->one();
		
		if ($model) {
			$result =	self::recursive($model['parent_id']);
			
			$result[] = [
					'id' => $model['id'],
					'parent_id' => $model['parent_id'],
					'name' => $model['name'],
					];
		}
		
		return (!empty($result))? $result : false;
	}	
	
}