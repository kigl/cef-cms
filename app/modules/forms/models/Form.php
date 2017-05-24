<?php

namespace app\modules\forms\models;

use Yii;

/**
 * This is the model class for table "{{%service_form}}".
 *
 * @property integer $id
 * @property integer $site_id
 * @property string $name
 * @property string $description
 * @property integer $captcha
 * @property string $email_from
 * @property string $email_curator
 * @property integer $send_email_curator
 * @property string $create_time
 *
 * @property Field[] $serviceFormFields
 */
class Form extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email_from', 'email_curator'], 'required', 'when' => function ($model) {
                return $model->send_email_curator;
            }],
            [['name'], 'required'],
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
            'captcha' => Yii::t('app', 'Use captcha'),
            'email_from' => Yii::t('forms', 'Email from'),
            'email_curator' => Yii::t('forms', 'Email curator'),
            'send_email_curator' => Yii::t('forms', 'Send email curator'),
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

    public function beforeSave($insert)
    {
        $this->site_id = Yii::$app->site->getId();

        return parent::beforeSave($insert);
    }
}
