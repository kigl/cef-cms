<?php

namespace app\modules\user\models;

use Yii;
use yii\web\HttpException;
use app\modules\user\models\User;

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
class LoginForm extends \yii\base\Model
{
    private $_user;

    public $login;
    public $password;

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }


    public function validatePassword($attribute)
    {
    	$user = $this->getUser();
    	
	    if (!$user or !Yii::$app->security->validatePassword($this->password, $user->password)) {
	        $this->addError($attribute, 'Логин или пароль введены неверно!');
	    }
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'login' => Yii::t('main', 'Login'),
            'password' => Yii::t('main', 'Password'),
        ];
    }

    public function login()
    {
        if ($this->validate() and $this->checkUser()) {
            Yii::$app->user->login($this->getUser());
            return true;
        }
        
        return false;
    }

    public function getUser()
    {
        if ($this->_user == null) {
            $this->_user = User::find()
            ->where(['login' => $this->login])
            ->orWhere(['email' => $this->login])
            ->one();
        }

        return $this->_user;
    }

    public function checkUser()
    {
        if ($this->_user->status == User::STATUS_ACTIVE) {
            return true;
        }
        else {
            throw new HttpException(403);
        }
    }
}





