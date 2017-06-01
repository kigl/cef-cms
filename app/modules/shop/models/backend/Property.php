<?php

namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;

class Property extends \app\modules\shop\models\Property
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['shop_id', 'name'], 'required'],
        ]);
    }

    public function beforeSave($insert)
    {
        if ($this->type != self::TYPE_SELECT) {
            $this->list_id = null;
        }

        return parent::beforeSave($insert);
    }
}
