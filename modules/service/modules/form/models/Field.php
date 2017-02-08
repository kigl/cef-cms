<?php

namespace app\modules\service\modules\form\models;

use Yii;

/**
 * This is the model class for table "{{%service_form_field}}".
 *
 * @property integer $id
 * @property integer $form_id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property integer $required
 *
 * @property Form $form
 * @property FieldValue[] $serviceFormFieldValues
 */
class Field extends \yii\db\ActiveRecord
{
    const FIELD_TYPE_TEXT = 1;
    const FIELD_TYPE_CHECKBOX = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_form_field}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'form_id', 'type'], 'required'],
            [['form_id', 'required', 'type'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['form_id'], 'exist', 'skipOnError' => true, 'targetClass' => Form::className(), 'targetAttribute' => ['form_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'form_id' => Yii::t('service', 'Form ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'type' => Yii::t('app', 'Field type'),
            'required' => Yii::t('app', 'Required'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(Form::className(), ['id' => 'form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceFormFieldValues()
    {
        return $this->hasMany(FieldValue::className(), ['field_id' => 'id']);
    }

    public function getListFieldType()
    {
        return [
            self::FIELD_TYPE_TEXT => Yii::t('app', 'Type field text'),
            self::FIELD_TYPE_CHECKBOX => Yii::t('app', 'Type field checkbox'),
        ];
    }

    public function getNameFieldType($type)
    {
        return $this->getListFieldType()[$type];
    }
}
