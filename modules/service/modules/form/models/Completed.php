<?php

namespace app\modules\service\modules\form\models;

use Yii;
use app\modules\user\models\User;

/**
 * This is the model class for table "{{%service_form_completed}}".
 *
 * @property integer $id
 * @property integer $form_id
 * @property integer $user_id
 * @property string $create_time
 *
 * @property User $user
 * @property FieldValue[] $serviceFormFieldValues
 */
class Completed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_form_completed}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_id' ,'user_id'], 'integer'],
            [['create_time'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'form_id' => Yii::t('user', 'User id'),
            'user_id' => Yii::t('app', 'User id'),
            'create_time' => Yii::t('app', 'Create time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldsValue()
    {
        return $this->hasMany(FieldValue::className(), ['form_completed_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(Form::className(), ['id' => 'form_id']);
    }
}
