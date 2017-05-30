<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "{{%shop_price_product}}".
 *
 * @property integer $id
 * @property integer $price_id
 * @property integer $product_id
 * @property string $value
 *
 * @property ShopPrice $price
 * @property ShopProduct $product
 */
class PriceProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_price_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price_id', 'product_id'], 'integer'],
            [['value'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'price_id' => Yii::t('shop', 'Price ID'),
            'product_id' => Yii::t('shop', 'Product ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrice()
    {
        return $this->hasOne(Price::className(), ['id' => 'price_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
