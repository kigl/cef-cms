<?php

namespace app\modules\users\models;

use Yii;
use app\core\db\ActiveRecord;

/**
 * This is the model class for table "{{%user_field}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property UserFieldRelation[] $userFieldRelations
 * @property User[] $users
 */
class Property extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_property}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sorting', 'required'], 'integer'],
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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'sorting' => Yii::t('app', 'Sorting'),
            'required' => Yii::t('app', 'Required'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(PropertyRelation::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%user_property_relation}}', ['property_id' => 'id']);
    }
}
