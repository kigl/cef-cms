<?php

namespace app\modules\admin;

use Yii;

class Module extends \app\components\Module
{
	public $itemsPerPage = 10;
	
	public static function getAllModules()
	{
		$deletedModule = ['gii', 'debug'];
		$modules = Yii::$app->modules;

		foreach ($deletedModule as $module) {
			if (isset($modules[$module])) {
				unset($modules[$module]);
			}
		}
		return $modules;
	}
	
	public static function getModuleList()
	{
		$modules = self::getAllModules();
		
		foreach ($modules as $key => $model) {
			$result[$key] = Yii::$app->getModule($key)->getName();
		}
		return $result;
	}
}