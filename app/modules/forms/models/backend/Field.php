<?php

namespace app\modules\forms\models\backend;


/**
 * This is the model class for table "{{%service_form_field}}".
 *
 * @property integer $id
 * @property integer $form_id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property integer $required
 * @property integer $sorting
 *
 * @property Form $form
 * @property FieldValue[] $serviceFormFieldValues
 */
class Field extends \app\modules\forms\models\Field
{
    public function beforeSave($insert)
    {
        if (($this->type != self::TYPE_SELECT) && ($this->type != self::TYPE_RADIO)) {
            $this->list_id = null;
        }

        return parent::beforeSave($insert);
    }
}
