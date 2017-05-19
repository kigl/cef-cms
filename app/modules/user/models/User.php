<?php

namespace app\modules\user\models;


use Yii;
use app\core\behaviors\file\ActionImage;
/**
 * This is the model class for table "mn_user".
 *
 * @property integer $id
 * @property string $login
 * @property string $surname
 * @property string $name
 * @property string $lastname
 * @property string $email
 * @property string $avatar
 * @property string $password
 * @property integer $status
 * @property integer $create_time
 * @property string $ip
 */
class User extends \app\core\db\ActiveRecord
{
    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'email', 'name'], 'required'],
            ['login', 'match', 'pattern' => '/^[a-z]+$/', 'message' => 'Символы от a-z'],
            [['login', 'email'], 'unique'],
            [['surname', 'name', 'lastname', 'password',], 'string', 'max' => 255],
            ['email', 'email'],
            [['status'], 'integer'],
            ['avatar', 'image'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'login' => Yii::t('app', 'Login'),
            'surname' => Yii::t('app', 'Surname'),
            'name' => Yii::t('app', 'Name'),
            'lastname' => Yii::t('app', 'Lastname'),
            'email' => Yii::t('app', 'Email'),
            'avatar' => Yii::t('app', 'Avatar'),
            'password' => Yii::t('app', 'Password'),
            'status' => Yii::t('app', 'Status'),
            'rolePermission' => Yii::t('app', 'Role and permission'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
            'ip' => Yii::t('app', 'IP'),
            'password_repeat' => Yii::t('app', 'Password repeat'),
        ];
    }

    public function behaviors()
    {
        return [
            'avatarUpload' => [
                'class' => ActionImage::className(),
                'path' => '@webroot/public/uploads/user',
                'pathUrl' => '@web/public/uploads/user',
                'attribute' => 'avatar',
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(PropertyRelation::className(), ['user_id' => 'id']);
    }

    public function getStatusList()
    {
        return [
            self::STATUS_BLOCK => Yii::t('app', 'Status block'),
            self::STATUS_ACTIVE => Yii::t('app', 'Status active'),
            self::STATUS_NOT_ACTIVE => Yii::t('app', 'Status not active'),
        ];
    }

    public function getStatus($status)
    {
        return $this->getStatusList()[$status];
    }
}
