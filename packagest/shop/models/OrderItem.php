<?php

namespace kigl\cef\module\shop\models;

use Yii;

/**
 * This is the model class for table "{{%shop_order_item}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $name
 * @property double $qty
 * @property double $price
 *
 * @property Order $order
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_order_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'integer'],
            [['qty', 'price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('shop', 'Order ID'),
            'name' => Yii::t('app', 'Name'),
            'qty' => Yii::t('shop', 'Qty'),
            'price' => Yii::t('shop', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
