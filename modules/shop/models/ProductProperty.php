<?php

namespace app\modules\shop\models;

use Yii;
use app\core\db\ActiveRecord;

/**
 * This is the model class for table "mn_shop_product_property".
 *
 * @property integer $product_id
 * @property integer $property_id
 * @property string $value
 */
class ProductProperty extends \app\modules\shop\models\base\ProductProperty
{
    protected static $_properties;

    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'property_id']);
    }
}
