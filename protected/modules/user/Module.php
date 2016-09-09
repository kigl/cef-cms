<?php

namespace app\modules\user;

use Yii;

/**
 * user module definition class
 */
class Module extends \app\modules\main\components\Module
{
	public function getName()
	{
		return Yii::t($this->id, 'Module name');
	}
	
	public function getDescription()
	{
		return Yii::t($this->id, 'Module name');
	}
}
