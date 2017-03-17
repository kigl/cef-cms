<?php

namespace kigl\cef\module\service\models\form;

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
        return '{{%service_form_field_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_completed_id', 'field_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['field_id'], 'exist', 'skipOnError' => true, 'targetClass' =>Field::className(), 'targetAttribute' => ['field_id' => 'id']],
            [['form_completed_id'], 'exist', 'skipOnError' => true, 'targetClass' => Completed::className(), 'targetAttribute' => ['form_completed_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('service', 'ID'),
            'form_completed_id' => Yii::t('service', 'Form Completed ID'),
            'field_id' => Yii::t('service', 'Field ID'),
            'value' => Yii::t('service', 'Value'),
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
