<?php

namespace app\modules\user\models;

use Yii;

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
class User extends \app\core\db\ActiveRecord
{
    public $password_repeat;

    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 2;

    const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_PASSWORD_RESET = 'resetPassword';

    public $rolePermission;

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
            [['login', 'email', 'password', 'password_repeat'], 'required', 'on' => self::SCENARIO_INSERT],

            ['login', 'match', 'pattern' => '/^[a-z]+$/', 'message' => 'Символы от a-z'],

            [['login', 'email'], 'required', 'on' => self::SCENARIO_UPDATE],

            [['surname', 'name', 'lastname', 'password', 'password_repeat'], 'string', 'max' => 255],
            ['password', 'string', 'min' => 6],
            ['password', 'compare'],
            ['email', 'email'],
            [['login', 'email'], 'unique'],
            [['status'], 'integer'],
            ['rolePermission', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'Id'),
            'role' => Yii::t('user', 'Role'),
            'login' => Yii::t('user', 'Login'),
            'surname' => Yii::t('user', 'Surname'),
            'name' => Yii::t('user', 'Name'),
            'lastname' => Yii::t('user', 'Lastname'),
            'email' => Yii::t('user', 'Email'),
            'password' => Yii::t('user', 'Password'),
            'status' => Yii::t('user', 'Status'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update time'),
            'ip' => Yii::t('user', 'Ip'),
            'password_repeat' => Yii::t('user', 'Password repeat'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\behaviors\TimeStampBehavior',
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ],
            'userIp' => [
                'class' => 'app\core\behaviors\UserIp',
                'attribute' => 'ip',
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->status = self::STATUS_ACTIVE;
        }

        if ($this->password == '') {
            $this->password = $this->getOldAttribute('password');
        } else {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }

        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldRelation()
    {
        return $this->hasMany(FieldRelation::className(), ['user_id' => 'id']);
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}


