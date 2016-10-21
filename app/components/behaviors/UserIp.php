<?php

namespace app\components\behaviors;

use yii\base\Model;

class UserIp extends \yii\base\Behavior
{
	public $attribute;
	
	public function events()
	{
		return [
			Model::EVENT_BEFORE_VALIDATE => 'getIp',
		];
	}
	
	public function getIp()
	{
		$this->owner->{$this->attribute} = $_SERVER['REMOTE_ADDR'];
	}
}
