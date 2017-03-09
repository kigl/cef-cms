<?php

namespace app\modules\user\models;



use app\core\behaviors\file\UploadImage;
use Yii;
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

    public $rolePermission;

    public $password_repeat;

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
            [['surname', 'name', 'lastname', 'password', 'password_repeat'], 'string', 'max' => 255],
           // ['password', 'string', 'min' => 6],
            ['password', 'compare',  'message' => Yii::t('user', 'Message: password do not match')],
            ['email', 'email'],
            [['login', 'email'], 'unique'],
            [['status'], 'integer'],
            ['rolePermission', 'safe'],
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
            'avatar' => Yii::t('user', 'Avatar'),
            'password' => Yii::t('app', 'Password'),
            'status' => Yii::t('app', 'Status'),
            'rolePermission' => Yii::t('user', 'Role and permission'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
            'ip' => Yii::t('app', 'IP'),
            'password_repeat' => Yii::t('app', 'Password repeat'),
        ];
    }

    public function behaviors()
    {
        return [
            'userIp' => [
                'class' => 'app\core\behaviors\UserIp',
                'attribute' => 'ip',
            ],
            'avatarUpload' => [
                'class' => UploadImage::className(),
                'path' => Yii::$app->getModule('user')->getPublicPath() . '/avatars',
                'pathUrl' => Yii::$app->getModule('user')->getPublicPathUrl() . '/avatars',
                'attribute' => 'avatar',
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->password === '') {
            $this->password = $this->getOldAttribute('password');
        } else {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }

        return parent::beforeSave($insert);
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFields()
    {
        return $this->hasMany(FieldRelation::className(), ['user_id' => 'id']);
    }

    public function getStatusList()
    {
        return [
            self::STATUS_BLOCK => Yii::t('user', 'Status block'),
            self::STATUS_ACTIVE => Yii::t('user', 'Status active'),
            self::STATUS_NOT_ACTIVE => Yii::t('user', 'Status not active'),
        ];
    }

    public function getStatus($status)
    {
        return $this->getStatusList()[$status];
    }
}
