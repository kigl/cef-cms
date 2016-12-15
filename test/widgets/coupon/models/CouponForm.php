<?php
/**
 * Class CouponForm
 * @package app\models
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\models;

use yii\base\Model;

class CouponForm extends Model
{

    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['name', 'string', 'max' => 20],
            ['email', 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'Email',
        ];
    }
}