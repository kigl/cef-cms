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
    const TYPE_TEXTAREA = 3;
    const TYPE_SELECT = 4;

    public function getListType()
    {
        return [
            self::TYPE_STRING => Yii::t('app', 'Type field text'),
            self::TYPE_CHECKBOX => Yii::t('app', 'Type field checkbox'),
            self::TYPE_TEXTAREA => Yii::t('app', 'Type field textarea'),
            self::TYPE_SELECT => Yii::t('app', 'Type field select'),
        ];
    }
}
