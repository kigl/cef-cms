<?php

namespace kigl\cef\module\shop\models;

use Yii;

/**
 * This is the model class for table "{{%shop_order_field}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property  integer $required
 *
 * @property OrderFieldRelation[] $shopOrderFieldRelations
 */
class OrderField extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_order_field}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            ['required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderFieldRelation()
    {
        return $this->hasMany(OrderFieldRelation::className(), ['field_id' => 'id']);
    }
}
