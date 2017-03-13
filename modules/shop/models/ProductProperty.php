<?php

namespace app\modules\shop\models;

use Yii;
use app\core\db\ActiveRecord;

/**
 * This is the model class for table "mn_shop_product_property".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $property_id
 * @property string $value
 */
class ProductProperty extends ActiveRecord
{

    public $requiredValue;

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
            ['value', 'required', 'when' => function ($model) {
                return $model->requiredValue;
            }],
            [['product_id', 'property_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            ['requiredValue', 'safe'],
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
            'value' => Yii::t('app', 'Property'),
        ];
    }

    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'property_id']);
    }
}
