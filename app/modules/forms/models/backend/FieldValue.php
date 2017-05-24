<?php

namespace app\modules\forms\models\backend;


/**
 * This is the model class for table "{{%service_form_field_value}}".
 *
 * @property integer $id
 * @property integer $form_completed_id
 * @property integer $field_id
 * @property string $value
 *
 * @property Field $field
 * @property Completed $formCompleted
 */
class FieldValue extends \app\modules\forms\models\FieldValue
{
}
