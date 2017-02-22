<?php

namespace app\modules\infosystem\models;

use Yii;

/**
 * This is the model class for table "{{%infosystem_property}}".
 *
 * @property integer $id
 * @property string $infosystem_id
 * @property string $name
 * @property string $description
 * @property integer $required
 *
 * @property ItemProperty[] $infosystemItemProperties
 * @property Infosystem $infosystem
 */
class Property extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%infosystem_property}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'infosystem_id'], 'required'],
            [['required'], 'integer'],
            [['infosystem_id'], 'string', 'max' => 100],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'infosystem_id' => Yii::t('app', 'Infosystem ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'required' => Yii::t('app', 'Required'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfosystemItemProperties()
    {
        return $this->hasMany(ItemProperty::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfosystem()
    {
        return $this->hasOne(Infosystem::className(), ['id' => 'infosystem_id']);
    }

    /**
     * @inheritdoc
     * @return PropertyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PropertyQuery(get_called_class());
    }
}
