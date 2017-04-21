<?php

namespace app\modules\lists\models\backend;


use Yii;

/**
 * This is the model class for table "{{%list}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 *
 * @property ListItem[] $listItems
 */
class Lists extends \app\modules\lists\models\Lists
{

}
