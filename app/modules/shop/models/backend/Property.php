<?php

namespace app\modules\shop\models\backend;


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
