<?php

namespace app\modules\service\modules\form\models;

use Yii;

/**
 * This is the model class for table "{{%service_form}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $captcha
 * @property string $email_curator
 * @property integer $send_email_curator
 * @property string $create_time
 *
 * @property ServiceFormField[] $serviceFormFields
 */
class Form extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_form}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['captcha', 'send_email_curator'], 'integer'],
            [['name', 'description', 'email_curator'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'captcha' => Yii::t('app', 'Captcha'),
            'email_curator' => Yii::t('service', 'Email curator'),
            'send_email_curator' => Yii::t('service', 'Send email curator'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFields()
    {
        return $this->hasMany(Field::className(), ['form_id' => 'id'])
            ->indexBy('id');
    }
}
