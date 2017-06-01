<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "{{%shop_product_packing}}".
 *
 * @property integer $id
 * @property integer $measure_id
 * @property integer $product_id
 * @property integer $main
 * @property string $name
 * @property number $value
 * @property number $length
 * @property number $width
 * @property number $height
 *
 * @property Measure $measure
 * @property Packing $parent
 * @property Packing[] $packings
 * @property Product $product
 */
class Packing extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_product_packing}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['measure_id', 'product_id', 'main'], 'integer'],
            [['value', 'length', 'width', 'height'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'measure_id' => Yii::t('app', 'Measure ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'main' => Yii::t('app', 'Main'),
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
            'length' => Yii::t('app', 'Length'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeasure()
    {
        return $this->hasOne(Measure::className(), ['id' => 'measure_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
