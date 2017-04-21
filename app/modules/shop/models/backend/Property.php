<?php

namespace app\modules\shop\models\backend;


/**
 * This is the model class for table "mn_shop_property".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $required
 */
class Property extends \app\modules\shop\models\Property
{
    public function beforeSave($insert)
    {
        if ($this->type != self::TYPE_SELECT) {
            $this->list_id = null;
        }

        return parent::beforeSave($insert);
    }
}
