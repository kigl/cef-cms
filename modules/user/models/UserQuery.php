<?php
/**
 * Class UserQuery
 * @package app\modules\user\models
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\models;


use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    public function byId($id)
    {
        return $this->where('id = :id', [':id' => $id]);
    }
}