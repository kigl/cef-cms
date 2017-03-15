<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 08.11.2016
 * Time: 17:28
 */

namespace kigl\cef\module\user\models;


use yii\web\IdentityInterface;

class UserIdentity extends User implements IdentityInterface
{
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return static::findOne(['access_token' => $token]);
    }

    public function generateAuthKey()
    {
        //$this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getAuthKey()
    {
        //return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        //return $this->auth_key === $authKey;
    }
}