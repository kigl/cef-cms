<?php

namespace app\modules\forms\models;

use Yii;

/**
 * This is the model class for table "{{%form_group}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $form_id
 * @property string $name
 * @property string $description
 * @property integer $sorting
 *
 * @property Form $form
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['parent_id', 'form_id', 'sorting'], 'integer'],
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
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'form_id' => Yii::t('forms', 'Form ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
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

    public function getField()
    {
        return $this->hasMany(Field::className(), ['group_id' => 'id']);
    }
}
