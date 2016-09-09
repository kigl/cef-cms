<?php

namespace app\modules\main;

use Yii;

/**
 * Main module definition class
 */
class Module extends \app\modules\main\components\Module
{
	public $itemsOnPage = 10;
	
	public function getName()
	{
		return Yii::t($this->id, 'Module name');
	}
	
	public function getDescription()
	{
		return Yii::t($this->id, 'Module description');
	}
	
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
