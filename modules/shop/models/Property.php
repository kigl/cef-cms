<?php

namespace app\modules\shop\models;

use Yii;
use app\core\db\ActiveRecord;

/**
 * This is the model class for table "mn_shop_property".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 */
class Property extends \app\modules\shop\models\base\Property
{
    const TYPE_STRING = 1;
    const TYPE_CHECKBOX = 2;

    public function getListType()
    {
        return [
            self::TYPE_STRING => Yii::t('shop', 'Property type string'),
            self::TYPE_CHECKBOX => Yii::t('shop', 'Property type checkbox'),
        ];
    }
}
