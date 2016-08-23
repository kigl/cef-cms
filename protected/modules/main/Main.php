<?php

namespace app\modules\main;

use Yii;

/**
 * Main module definition class
 */
class Main extends \app\modules\main\components\Module
{
	
	public function getProtectedPathUrl()
	{
		return Yii::$app->request->getHostInfo() . '/protected';
	}
	
	public function getModulePublicPath()
	{
		return $this->basePath . DS . 'public';
	}
	
	public function getModulePublicPathUrl()
	{
		return $this->getProtectedPathUrl() . '/modules/' . $this->id . '/public'; 
	}
	
	public function getModuleImagesPath()
	{
		return $this->getModulePublicPath() . DS . 'images';
	}
	
	public function getModuleImagesPathUrl()
	{
		return $this->getModulePublicPathUrl() . '/images';
	}
}
