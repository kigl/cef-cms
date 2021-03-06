<?php

namespace app\modules\forms\models\backend;

use Yii;

/**
 * This is the model class for table "{{%form_group}}".
 *
 * @property integer $id
 * @property integer $form_id
 * @property string $name
 * @property string $description
 * @property integer $sorting
 *
 * @property Form $form
 */
class Group extends \app\modules\forms\models\Group
{
}
