<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.01.2017
 * Time: 20:27
 */

namespace app\modules\tag\models;


use yii\db\ActiveQuery;

class TagQuery extends ActiveQuery
{
    public function byId($id)
    {
        $this->where('id = :id', [':id' => $id]);

        return $this;
    }
}