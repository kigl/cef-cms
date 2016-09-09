<?php
namespace app\modules\main\components;

use Yii;

abstract class Module extends \yii\base\Module
{	
	public $defaultBackendRoute = 'backend/default';

	abstract public function getName();

	abstract public function getDescription();
	
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