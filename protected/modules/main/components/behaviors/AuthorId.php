<?php

namespace app\modules\main\components\behaviors;

use Yii;
use yii\db\ActiveRecord;

class AuthorId extends \yii\base\Behavior
{	
	public $attribute = 'author';
	
	public function events()
	{
		return [
			ActiveRecord::EVENT_BEFORE_INSERT => 'recordUserId',
		];	
	}
	
	public function recordUserId()
	{
		$this->owner->{$this->attribute} = Yii::$app->user->getId();
	}
}

?>