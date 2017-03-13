<?php

namespace app\modules\property\models;

use app\modules\infosystem\models\Infosystem;
use Yii;

/**
 * This is the model class for table "{{%property}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $required
 * @property integer $sorting
 * @property integer $type
 * @property string $infosystem_id
 * @property string $model_class
 * @property integer $list_id
 * @property string $create_time
 * @property string $update_time
 *
 * @property PropertyValue[] $propertyValues
 */
class Property extends \app\core\db\ActiveRecord
{
    const TYPE_STRING = 1;
    const TYPE_CHECKBOX = 2;
    const TYPE_TEXTAREA = 3;
    const TYPE_SELECT = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%property}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sorting', 'type', 'list_id', 'required'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'description', 'infosystem_id', 'model_class'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'required' => Yii::t('app', 'Required'),
            'description' => Yii::t('app', 'Description'),
            'sorting' => Yii::t('app', 'Sorting'),
            'type' => Yii::t('app', 'Type'),
            'infosystem_id' => Yii::t('app', 'Infosystem ID'),
            'model_class' => Yii::t('app', 'Model Class'),
            'list_id' => Yii::t('app', 'List ID'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @inheritdoc
     * @return PropertyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PropertyQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValues()
    {
        return $this->hasMany(PropertyValue::className(), ['property_id' => 'id']);
    }

    public function getInfosystem()
    {
        return $this->hasOne(Infosystem::className(), ['id' => 'infosystem_id']);
    }

    public function getListType()
    {
        return [
            self::TYPE_STRING => Yii::t('app', 'Type field text'),
            self::TYPE_CHECKBOX => Yii::t('app', 'Type field checkbox'),
            self::TYPE_TEXTAREA => Yii::t('app', 'Type field textarea'),
            self::TYPE_SELECT => Yii::t('app', 'Type field select'),
        ];
    }
}
