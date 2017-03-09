<?php

namespace app\modules\backend;

use Yii;

class Module extends \app\core\module\Module
{
    public $defaultBackendRoute = 'default/index';

    public $controllerMap = [
        'default' => 'app\modules\backend\controllers\DefaultController',
    ];

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

    public static function t($message, $params = [])
    {
        return Yii::t(self::getInstance()->id, $message, $params);
    }
}