<?php
namespace app\modules\user\models;


use Yii;
use yii\base\Model;

class RestoreAccessForm extends Model
{
    public $email;
    
    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'hasUserEmail'],
        ];
    }
    
    public function hasUserEmail($attribute)
    {
        $user = User::find()
            ->byEmail($this->$attribute)
            ->asArray()
            ->select(['email'])
            ->one();
        if (!$user) {
            $this->addError($attribute, Yii::t('user', 'Error: not user with this {email}', ['email' => $this->$attribute]));
        }
    }

    public function attributeLabels()
    {
        [
            'email' => Yii::t('user', 'Email'),
        ];
    }
}