<?php
namespace app\models;


use yii\db\ActiveRecord;

class SenderContact extends ActiveRecord
{
    public static function tableName()
    {
        return 'b_sender_contact';
    }

    public function rules()
    {
        return [
            ['EMAIL', 'required'],
            ['EMAIL', 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'EMAIL' => 'Email',
        ];
    }
}