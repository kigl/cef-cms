<?php
namespace app\models;


use yii\db\ActiveRecord;

class SenderContactList extends ActiveRecord
{
    public static function tableName()
    {
        return 'b_sender_contact_list';
    }
}