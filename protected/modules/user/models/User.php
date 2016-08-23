<?php

namespace app\modules\user\models;

use Yii;
use yii\web\HttpException;

/**
* This is the model class for table "mn_user".
*
* @property integer $id
* @property integer $role
* @property string $login
* @property string $surname
* @property string $name
* @property string $lastname
* @property string $email
* @property string $password
* @property integer $status
* @property integer $create_time
* @property string $ip
*/
class User extends \app\modules\main\components\ActiveRecord implements \yii\web\IdentityInterface
{
    public $passwordConfirm;

    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 2;


    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'mn_user';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['login', 'email', 'password', 'passwordConfirm'], 'required', 'on' => 'insert'],

            [['login', 'email'], 'required', 'on' => 'update'],

            [['password', 'passwordConfirm'], 'required', 'on' => 'passwordEdit'],

            [['surname', 'name', 'lastname'], 'string', 'max' => 255],
            ['passwordConfirm', 'validatePasswordConfirm'],
            ['email', 'email'],
            [['status'], 'integer'],
            // [['login', 'email', 'ip'], 'string', 'max' => 50],
            //[['surname', 'name', 'lastname'], 'string', 'max' => 100],
            //[['password'], 'string', 'max' => 255],
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'role' => Yii::t('main', 'Role'),
            'login' => Yii::t('main', 'Login'),
            'surname' => Yii::t('main', 'Surname'),
            'name' => Yii::t('main', 'Name'),
            'lastname' => Yii::t('main', 'Lastname'),
            'email' => Yii::t('main', 'Email'),
            'password' => Yii::t('main', 'Password'),
            'status' => Yii::t('main', 'Status'),
            'create_time' => Yii::t('main', 'Create Time'),
            'ip' => Yii::t('main', 'Ip'),
        ];
    }

    public function validatePasswordConfirm($attribute)
    {
        if ($this->password != $this->passwordConfirm) {
            $this->addError($attribute, 'Пароль не совподает');
        }
    }

    public function behaviors()
    {
        return [
            'fillingTime' => [
                'class' => 'app\modules\main\components\behaviors\FillingTime',
                'create' => 'create_time',
            ],
            'userIp' => [
                'class' => 'app\modules\user\components\behaviors\UserIp',
                'attribute' => 'ip',
            ],
            'HashPassword' => [
                'class' => 'app\modules\main\components\behaviors\HashPassword',
                'attribute' => 'password',
            ],
        ];
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_BLOCK => Yii::t('main',  'user block'),
            self::STATUS_ACTIVE => Yii::t('main', 'user active'),
            self::STATUS_NOT_ACTIVE => Yii::t('main', 'user not active'),
        ];
    }

    public static function getStatus($status)
    {
        $result = self::getStatusList();

        return $result[$status];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->status = self::STATUS_ACTIVE;
        }

        return parent::beforeSave($insert);
    }

    /*
    * Аутентификация пользователя
    */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
}


