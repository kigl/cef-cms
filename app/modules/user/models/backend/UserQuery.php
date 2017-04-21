<?php
/**
 * Class UserQuery
 * @package app\modules\user\models
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\models\backend;


use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    public function byId($id)
    {
        return $this->where('id = :id', [':id' => $id]);
    }

    public function byEmail($email)
    {
        return $this->where(['email' => $email]);
    }
}