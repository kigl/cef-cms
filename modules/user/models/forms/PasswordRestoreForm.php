<?php

namespace app\modules\user\models\forms;


use Yii;
use yii\base\Model;
use app\modules\user\models\User;

class PasswordRestoreForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'hasUserWithEmail'],
        ];
    }

    public function hasUserWithEmail($attribute)
    {
        $user = User::find()
            ->byEmail($this->$attribute)
            ->select(['email'])
            ->asArray()
            ->one();

        if (!$user) {
            $this->addError($attribute, Yii::t('user', 'No user with this email'));
        }
    }

    public function attributeLabels()
    {
        [
            'email' => Yii::t('user', 'Email'),
        ];
    }
}