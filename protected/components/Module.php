<?php
namespace app\components;

use Yii;
use yii\helpers\ArrayHelper;

abstract class Module extends \yii\base\Module
{	
	public $defaultBackendRoute = 'default';

	public function getName()
	{
		return Yii::t($this->id, 'Module name');
	}

	public function getDescription()
	{
		return Yii::t($this->id, 'Module description');
	}
	
	public function getProtectedPathUrl()
	{
		return Yii::$app->request->getHostInfo() . '/protected';
	}
	
	public function getPublicPath()
	{
		return $this->basePath . DS . 'public';
	}
	
	public function getPublicPathUrl()
	{
		return $this->getProtectedPathUrl() . '/modules/' . $this->id . '/public'; 
	}
	
	public function getImagesPath()
	{
		return $this->getPublicPath() . DS . 'images';
	}
	
	public function getImagesPathUrl()
	{
		return $this->getPublicPathUrl() . '/images';
	}
}