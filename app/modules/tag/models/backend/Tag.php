<?php

namespace app\modules\tag\models\backend;

use Yii;

/**
 * This is the model class for table "mn_tag".
 *
 * @property integer $id
 * @property string $name
 */
class Tag extends \app\modules\tag\models\Tag
{
    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}
