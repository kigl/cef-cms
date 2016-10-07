<?php

namespace app\modules\informationsystem\controllers;

use app\modules\informationsystem\models\Informationsystem as System;

class VideoController extends \app\modules\informationsystem\controllers\FrontentControllerAbstract
{
	public $systemId = 'video';
	
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
			'url' => ['video/manager'],
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
								'video/manager',
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
