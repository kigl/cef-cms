<?php

namespace app\modules\main\components\behaviors;

use yii\base\Model;

class FillingTime extends \yii\base\Behavior
{
	public $update;
	public $create;

	public function events()
	{
		return [
			Model::EVENT_BEFORE_VALIDATE => 'getTime',
		];
	}

	public function getTime()
	{
		if ($this->update != null ) {
			$this->owner->{$this->update} = time();
		}

		if ($this->owner->isNewRecord) {
			if (isset($this->create)) {
				$this->owner->{$this->create} = time();
			}
		}
	}
}