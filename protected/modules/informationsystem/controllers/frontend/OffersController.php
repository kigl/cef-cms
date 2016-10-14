<?php

namespace app\modules\informationsystem\controllers;

use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\models\InformationsystemItem as Item;

class OffersController extends \app\modules\informationsystem\controllers\FrontentControllerAbstract
{
	public $systemId = 'offers';
	
	public function actionView($id)
	{
		$model = Item::findOne($id);
		
		return $this->renderPartial('view', ['model' => $model]);
	}
	
	/**
	*	Строит путь с вложениями для виджета Breadcrumbs
	* @param integer $id
	* 
	* @return array | false
	*/
	public static function buildBreadcrumbs($id = null, $informationsystem_id)
	{
		$modelSystem = System::getSystem($informationsystem_id);

		$result[] = [
			'label' => $modelSystem->name,
			'url' => ['offers/manager'],
		];
		
		if ($id !== null and $breadcrumbs = parent::recursive($id)) {
			$c = count($breadcrumbs) - 1;
			$breadcrumbs[$c]['span'] = 1;
			
			foreach ($breadcrumbs as $model)
			{
				if (!isset($model['span'])) {
					$result[] = [
							'label' => $model['name'],
							'url' => [
								'offers/manager',
								'group_id' => $model['id'],
							]
					];		
				} else {
					$result[] = ['label' => $model['name']];				
				}
			}
		}
		
		return (!empty($result))? $result : null;
	}
}
