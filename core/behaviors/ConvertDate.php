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
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
        ];
    }

    public function beforeSave($event)
    {
        if ($this->owner{$this->attribute} != '') {
            $this->owner->{$this->attribute} = Yii::$app->formatter->asDate($this->owner->{$this->attribute}, $this->format);
        }
    }
}