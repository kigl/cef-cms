<?php

namespace app\core\behaviors;

use Yii;
use yii\db\ActiveRecord;

class ConvertDate extends \yii\base\Behavior
{
    public $attribute;

    public $format = 'yyyy-MM-dd';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }

    public function beforeValidate($event)
    {
        if ($this->owner{$this->attribute} != '') {
            $this->owner->{$this->attribute} = Yii::$app->formatter->asDate($this->owner->{$this->attribute}, $this->format);
        }
    }
}