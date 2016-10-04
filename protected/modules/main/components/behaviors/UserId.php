<?php

namespace app\modules\main\components\behaviors;

use Yii;
use yii\db\ActiveRecord;

class UserId extends \yii\base\Behavior
{	
	public $attribute = 'user_id';
	
	public function events()
	{
		return [
			ActiveRecord::EVENT_BEFORE_INSERT => 'recordUserId',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'recordUserId',
		];	
	}
	
	public function recordUserId()
	{
		$this->owner->{$this->attribute} = Yii::$app->user->getId();
	}
}

?>