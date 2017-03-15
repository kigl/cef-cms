<?php

namespace kigl\cef\core\behaviors;

use yii\db\ActiveRecord;

class FillData extends \yii\base\Behavior
{
	public $attribute;
	public $setAttribute;

	public $filling;

	public function events()
	{
		return [
			ActiveRecord::EVENT_BEFORE_INSERT => 'getData',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'getData',
		];
	}

	public function getData($event)
	{
		if ($this->owner->{$this->setAttribute} === '') {
			$this->owner->{$this->setAttribute} = $this->owner->{$this->attribute};
		}
	}
}