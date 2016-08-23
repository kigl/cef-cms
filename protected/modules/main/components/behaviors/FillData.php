<?php

namespace app\modules\main\components\behaviors;

use yii\base\Model;

class FillData extends \yii\base\Behavior
{
	public $fillingUp;

	public $filling;

	public function events()
	{
		return [
			Model::EVENT_AFTER_VALIDATE => 'getData',
		];
	}

	public function getData($event)
	{
		if ($this->owner->{$this->filling} == '') {
			$this->owner->{$this->filling} = $this->owner->{$this->fillingUp};
		}
	}
}