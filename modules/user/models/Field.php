<?php

namespace app\modules\user\models;

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
class Field extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_field}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldRelations()
    {
        return $this->hasMany(FieldRelation::className(), ['field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%user_field_relation}}', ['field_id' => 'id']);
    }
}
