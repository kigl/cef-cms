<?php

namespace app\modules\user\models;

use app\core\session\Flash;
use Yii;
use yii\helpers\ArrayHelper;

class UserRegistration extends User
{
    public $verifyCode;

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_BEFORE_INSERT, function ($event) {
           Yii::$app->session->setFlash(
               Flash::FLASH_SUCCESS,
               Yii::t('user', 'You have registered, use your email and password to access the site'));
        });
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha'],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'verifyCode' => Yii::t('user', 'Captcha form'),
        ]);
    }
}