<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "{{%user_field_relation}}".
 *
 * @property integer $user_id
 * @property integer $field_id
 * @property string $value
 *
 * @property UserField $field
 * @property User $user
 */
class FieldRelation extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_field_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'field_id'], 'required'],
            [['user_id', 'field_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('user', 'User ID'),
            'field_id' => Yii::t('user', 'Field ID'),
            'value' => Yii::t('user', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(Field::className(), ['id' => 'field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
