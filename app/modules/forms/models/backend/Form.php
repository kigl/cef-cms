<?php

namespace app\modules\forms\models\backend;


/**
 * This is the model class for table "{{%service_form}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $captcha
 * @property string $email_from
 * @property string $email_curator
 * @property integer $send_email_curator
 * @property string $create_time
 *
 * @property Field[] $serviceFormFields
 */
class Form extends \app\modules\forms\models\Form
{
}
