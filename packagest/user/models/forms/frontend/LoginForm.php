<?php

namespace kigl\cef\module\user\models\forms\frontend;

use Yii;
use yii\base\Model;
use yii\web\HttpException;
use kigl\cef\module\user\models\User;
use kigl\cef\module\user\models\UserIdentity;

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
class LoginForm extends Model
{
    private $model = null;

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
        $model = $this->getUser();

        if (!$model || !Yii::$app->security->validatePassword($this->password, $model->password)) {
            $this->addError($attribute, Yii::t('app', 'Login or password is incorrect'));
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => Yii::t('user', 'Login or email'),
            'password' => Yii::t('user', 'Password'),
        ];
    }

    public function login()
    {
        if ($this->validate() and $this->checkUser(true)) {
            Yii::$app->user->login($this->getUser());
            return true;
        }

        return false;
    }

    public function checkUser($status = true)
    {
        $model = $this->getUser();

        if ($status) {
            if ($model->status === User::STATUS_ACTIVE) {
                return true;
            } else {
                throw new HttpException(403);
            }
        }

        return true;
    }

    public function getUser()
    {
        if (is_null($this->model)) {
            $this->model = UserIdentity::find()
                ->where(['login' => $this->login])
                ->orWhere(['email' => $this->login])
                ->one();
        }

        return $this->model;
    }
}
