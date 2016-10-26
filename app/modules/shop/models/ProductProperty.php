<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "mn_shop_product_property".
 *
 * @property integer $product_id
 * @property integer $property_id
 * @property string $value
 */
class ProductProperty extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_shop_product_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'property_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('shop', 'Product id'),
            'property_id' => Yii::t('shop', 'Property id'),
            'value' => Yii::t('shop', 'Value'),
        ];
    }
}
