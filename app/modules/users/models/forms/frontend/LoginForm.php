<?php

namespace app\modules\users\models\forms\frontend;

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
    public $login;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
        ];
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
}
