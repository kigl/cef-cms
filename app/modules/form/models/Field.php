<?php

namespace app\modules\form\models;

use Yii;

/**
 * This is the model class for table "{{%service_form_field}}".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $form_id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property integer $required
 * @property integer $sorting
 *
 * @property Form $form
 * @property FieldValue[] $serviceFormFieldValues
 */
class Field extends \yii\db\ActiveRecord
{
    const TYPE_TEXT = 1;
    const TYPE_CHECKBOX = 2;
    const TYPE_RADIO = 3;
    const TYPE_SELECT = 4;
    const TYPE_TEXTAREA = 5;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_field}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'form_id', 'type'], 'required'],
            [['group_id', 'form_id', 'required', 'type', 'list_id', 'sorting'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            ['sorting', 'default', 'value' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'group_id' => Yii::t('app', 'Group ID'),
            'form_id' => Yii::t('form', 'Form ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'type' => Yii::t('app', 'Field type'),
            'list_id' => Yii::t('app', 'List'),
            'required' => Yii::t('app', 'Required'),
            'sorting' => Yii::t('app', 'Sorting'),
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

    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function getListFieldType()
    {
        return [
            self::TYPE_TEXT => Yii::t('app', 'Type field text'),
            self::TYPE_TEXTAREA => Yii::t('app', 'Type field textarea'),
            self::TYPE_CHECKBOX => Yii::t('app', 'Type field checkbox'),
            self::TYPE_RADIO => Yii::t('app', 'Type field radio'),
            self::TYPE_SELECT => Yii::t('app', 'Type field select'),
        ];
    }

    public static function getNameFieldType($type)
    {
        return (new self)->getListFieldType()[$type];
    }
}
