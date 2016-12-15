<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "runtime_table_coupon_user".
 *
 * @property integer $id
 * @property string $user_name
 * @property string $user_email
 * @property integer $status
 * @property string $coupon
 * @property string $update_time
 */
class Coupon extends \yii\db\ActiveRecord
{
    const STATUS_COUPON_ISSUED = 1;
    const STATUS_COUPON_NOT_ISSUED = 0;

    protected $emailFrom = 'mail@anomoda.ru';
    protected $emailSubject = 'Купон на покупку';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'runtime_table_coupon_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'user_email', 'status', 'coupon'], 'required'],
            [['status'], 'integer'],
            [['update_time'], 'safe'],
            [['user_name', 'user_email'], 'string', 'max' => 255],
            [['coupon'], 'string', 'max' => 32],
            [['user_email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'user_email' => 'User Email',
            'status' => 'Status',
            'coupon' => 'Coupon',
            'update_time' => 'Update Time',
        ];
    }

    public function getOneItem()
    {
        $model = self::find()->where('status = :status', [':status' => self::STATUS_COUPON_NOT_ISSUED])->one();

        return $model;
    }

    public function sendEmail()
    {
        $mail = Yii::$app->mailer->compose('index', ['model' => $this])
            ->setFrom($this->emailFrom)
            ->setTo($this->user_email)
            ->setSubject($this->emailSubject);

        return $mail->send();
    }
}
