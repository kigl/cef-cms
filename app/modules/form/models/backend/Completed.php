<?php

namespace app\modules\form\models\backend;

use Yii;
use app\modules\user\models\base\User;

/**
 * This is the model class for table "{{%service_form_completed}}".
 *
 * @property integer $id
 * @property integer $form_id
 * @property integer $user_id
 * @property string $create_time
 *
 * @property User $user
 * @property FieldValue[] $serviceFormFieldValues
 */
class Completed extends \app\modules\form\models\Completed
{
}
