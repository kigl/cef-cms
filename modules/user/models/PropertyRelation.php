<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "{{%user_property_relation}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $field_id
 * @property string $value
 *
 * @property Property $field
 * @property User $user
 */
class PropertyRelation extends \app\core\db\ActiveRecord
{
    /**
     * Виртуальное поле, не сохраняется
     * Используется для отображения названия свойства
     * @var
     */
    public $name;
    /**
     * Виртуальное поле, не сохраняется
     * Используется для валидации
     * @var
     */
    public $requiredValue;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_property_relation}}';
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
            [['property_id'], 'required'],
            [['user_id', 'property_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['name', 'requiredValue'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'property_id' => Yii::t('app', 'Property ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'property_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
