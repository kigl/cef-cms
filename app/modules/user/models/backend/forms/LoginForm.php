<?php

namespace app\modules\user\models\backend\forms;


use Yii;
use yii\base\Model;
use app\modules\user\models\UserIdentity;

class LoginForm extends Model
{
    public $login;
    public $password;

    protected $_user = null;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [
                'login',
                'match',
                'pattern' => '/^[a-zA-Z0-9_-]+$/',
                'message' => Yii::t('user', 'Symbols "a-zA-Z0-9_-"'),
            ],
            ['login', 'validateUserLogin'],
            ['password', 'validateUserPassword'],
        ];
    }

    public function validateUserLogin($attribute, $params)
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addError($attribute, Yii::t('user', 'Login is not valid'));
        }
    }

    public function validateUserPassword($attribute, $params)
    {
        $user = $this->getUser();

        if ($user && !Yii::$app->security->validatePassword($this->password, $user->password)) {
            $this->addError($attribute, Yii::t('user', 'Password is incorrect'));
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => Yii::t('app', 'Login'),
            'password' => Yii::t('app', 'Password'),
        ];
    }

    public function getUser()
    {
        if (is_null($this->_user)) {
            $this->_user = UserIdentity::findOne(['login' => $this->login]);
        }

        return $this->_user;
    }
}
