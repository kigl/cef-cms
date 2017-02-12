<?php

namespace app\modules\user\models\forms;


use Yii;
use yii\base\Model;

class UserRegistrationForm extends Model
{
    public $verifyCode;

    public $login;

    public $email;

    public $password;

    public $password_repeat;

    public function rules()
    {
        return [
            [['login', 'email', 'password', 'password_repeat'], 'required'],
            ['login', 'match', 'pattern' => '/^[a-z]+$/', 'message' => 'Символы от a-z'],
            ['email', 'email'],
            ['password', 'compare'],
            ['verifyCode', 'captcha', 'captchaAction' => '/frontend/site/captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'Id'),
            'role' => Yii::t('user', 'Role'),
            'login' => Yii::t('user', 'Login'),
            'email' => Yii::t('user', 'Email'),
            'password' => Yii::t('user', 'Password'),
            'password_repeat' => Yii::t('user', 'Password repeat'),
            'verifyCode' => Yii::t('user', 'Verify code'),
        ];
    }
}