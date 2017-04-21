<?php

namespace app\modules\lists\models\backend;


use Yii;

/**
 * This is the model class for table "{{%list_item}}".
 *
 * @property integer $id
 * @property integer $list_id
 * @property string $value
 * @property string $description
 * @property integer $sorting
 *
 * @property Lists $list
 */
class Item extends \app\modules\lists\models\Item
{

}
