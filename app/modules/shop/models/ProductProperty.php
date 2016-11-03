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
class ProductProperty extends ActiveRecord
{
    protected static $_properties;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_product_property}}';
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

    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'property_id']);
    }

    /**
     * @param Product $model
     * @return mixed
     */
    public static function initProperty(Product $model)
    {
        static::$_properties = $model->getProductProperty()->with('property')->indexBy('property_id')->all();
        $allProperty = Property::find()->indexBy('id')->all();

        foreach (array_diff_key($allProperty, static::$_properties) as $property) {
            static::$_properties[$property->id] = new self;
            static::$_properties[$property->id]->property_id = $property->id;
        }

        return static::$_properties;
    }

    /**
     * @param Product $model
     */
    public static function saveProperty(Product $model)
    {
        foreach (static::$_properties as $property) {
            $property->product_id = $model->id;

            if (isset($property->value) and $property->validate()) {
                $property->save(false);
            } else {
                // $property->delete();
            }
        }
    }
}
