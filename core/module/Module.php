<?php
namespace app\core\module;

use Yii;

abstract class Module extends \yii\base\Module implements ModuleInterface
{
	public $defaultRoute = 'default';

	public function getName()
	{
		return Yii::t($this->id, 'Module name');
	}

	public function getDescription()
	{
		return Yii::t($this->id, 'Module description');
	}

	public function getAppPathUrl()
	{
		return Yii::$app->request->getHostInfo() . '/';
	}

	public function getPublicPath()
	{
		return $this->basePath . DIRECTORY_SEPARATOR . 'public';
	}

	public function getPublicPathUrl()
	{
		return $this->getAppPathUrl() . '/modules/' . $this->id . '/public';
	}
}