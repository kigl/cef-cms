<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "mn_shop_order_field_relation".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $field_id
 *
 * @property OrderField $field
 * @property Order $order
 */
class OrderFieldRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_shop_order_field_relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'field_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'field_id' => 'Field ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(OrderField::className(), ['id' => 'field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
