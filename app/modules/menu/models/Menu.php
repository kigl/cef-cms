<?php

namespace app\modules\menu\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $class
 * @property string $attribute_id
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['name', 'class', 'attribute_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'name' => Yii::t('app', 'Name'),
            'class' => Yii::t('menu', 'CSS class menu'),
            'attribute_id' => Yii::t('menu', 'Attribute id menu'),
        ];
    }

    public function getItems()
    {
        return $this->hasMany(Item::className(), ['menu_id' => 'id']);
    }
}
