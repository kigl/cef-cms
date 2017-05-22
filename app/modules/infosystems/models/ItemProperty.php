<?php

namespace app\modules\infosystems\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%infosystem_item_property}}".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $property_id
 * @property string $value
 *
 * @property Item $item
 * @property Property $property
 */
class ItemProperty extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%infosystem_item_property}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'property_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'property_id' => Yii::t('app', 'Property ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'property_id']);
    }
}
