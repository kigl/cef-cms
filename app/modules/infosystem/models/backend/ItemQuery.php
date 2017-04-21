<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.01.2017
 * Time: 20:12
 */

namespace app\modules\infosystem\models\backend;


use yii\db\ActiveQuery;

class ItemQuery extends ActiveQuery
{
    public function byId($id)
    {
        return $this->where('id = :id', [':id' => $id]);
    }
}