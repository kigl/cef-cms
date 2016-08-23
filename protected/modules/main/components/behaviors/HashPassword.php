<?php

namespace app\modules\main\components\behaviors;

use Yii;
use yii\db\ActiveRecord;

class HashPassword extends \yii\base\Behavior
{
	public $attribute;
	
	public function events()
	{
		return [
			ActiveRecord::EVENT_BEFORE_INSERT => 'GeneratePassword',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'GeneratePassword',
		];
	}
	
	public function generatePassword()
	{
		$this->owner->{$this->attribute} = Yii::$app->security->generatePasswordHash($this->owner->{$this->attribute}); 
	}
}

?>