<?php

namespace app\modules\form\models;

use Yii;

/**
 * This is the model class for table "{{%service_form_field_value}}".
 *
 * @property integer $id
 * @property integer $form_completed_id
 * @property integer $field_id
 * @property string $value
 *
 * @property Field $field
 * @property Completed $formCompleted
 */
class FieldValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_field_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_completed_id', 'field_id'], 'integer'],
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
            'form_completed_id' => Yii::t('form', 'Form Completed ID'),
            'field_id' => Yii::t('form', 'Field ID'),
            'value' => Yii::t('form', 'Value'),
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
    public function getCompleted()
    {
        return $this->hasOne(Completed::className(), ['id' => 'form_completed_id']);
    }
}
