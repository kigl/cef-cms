<?php

namespace app\modules\main\widgets\adminMenuLeft;

use Yii;

class Widget extends \yii\base\Widget
{
	public function run()
	{
		// присваеваем маасив меню
		$menuModules = $this->getMenuModules();
		
		return $this->render('index', $menuModules);
	}
	
	/**
	* Сканирует и объеденяет массивы меню модулей
	*
	* @return array
	*/
	protected function getMenuModules()
	{
		$dirModules = Yii::getAlias('@app/modules');
		$modulesConfig = ':modulePath/config/menu.php';
	 // сканируем папки
		$scanDir = scandir($dirModules);
		// удаляем пути перехода из массива
		unset($scanDir[0], $scanDir[1]);
		
		$result = [];
		$fa = [];
		foreach ($scanDir as $dir) {
			$path = $dirModules . DS . str_replace(':modulePath', $dir, $modulesConfig);
			// проверяем наличие файла
			if (is_file($path)) {
				$fa = include $path;	
			}
			// объеденяем массивы
			$result = array_merge_recursive($result, $fa);
		}
		
		return $result;
	}
}
