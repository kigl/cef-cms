<?php

namespace app\modules\shop\models\base;

use Yii;

/**
 * This is the model class for table "{{%shop_order_field}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 *
 * @property ShopOrderFieldRelation[] $shopOrderFieldRelations
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
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
