<?php

namespace kigl\cef\module\user\models;


use Yii;
use yii\helpers\ArrayHelper;
use kigl\cef\module\user\components\RbacService;
use kigl\cef\core\behaviors\file\ActionImage;
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
class User extends \kigl\cef\core\db\ActiveRecord
{
    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 2;

    /**
     * Виртуальное поле, не сохраняется в текущую db
     * Используется для отображения ролей и сохраниния связей в authManager
     * @var
     */
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
            ['avatar', 'image'],
            ['rolePermission', 'safe'],
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
                'class' => 'kigl\cef\core\behaviors\UserIp',
                'attribute' => 'ip',
            ],
            'avatarUpload' => [
                'class' => ActionImage::className(),
                'path' => '@webroot/public/uploads/user/avatars',
                'pathUrl' => '@web/public/uploads/user/avatars',
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

    public function getListRoleItem()
    {
        return ArrayHelper::map(
            (new RbacService())->getItems(),
            'name', 'name', 'type'
        );
    }
}
