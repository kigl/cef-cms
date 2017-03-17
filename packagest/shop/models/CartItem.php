<?php

namespace kigl\cef\module\shop\models;

use Yii;

/**
 * This is the model class for table "{{%shop_cart_item}}".
 *
 * @property integer $id
 * @property integer $cart_id
 * @property integer $product_id
 * @property integer $qty
 * @property double $price
 *
 * @property Product $product
 * @property Cart $cart
 */
class CartItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_cart_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cart_id', 'product_id', 'qty'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cart_id' => Yii::t('shop', 'Cart ID'),
            'product_id' => Yii::t('shop', 'Product ID'),
            'qty' => Yii::t('shop', 'Qty'),
            'price' => Yii::t('shop', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCart()
    {
        return $this->hasOne(Cart::className(), ['id' => 'cart_id']);
    }
}
