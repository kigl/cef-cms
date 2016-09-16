<?php

namespace app\modules\informationsystem;

use Yii;

/**
 * informationsystem module definition class
 */
class Module extends \app\modules\main\components\Module
{
	public $defaultBackendRoute = 'backend/manager';
	
	public $itemsPerPage = 10;
	
	public function getName()
	{
		return Yii::t($this->id, 'Module name');
	}
	
	public function getDescription()
	{
		return Yii::t($this->id, 'Module description');
	}
}
