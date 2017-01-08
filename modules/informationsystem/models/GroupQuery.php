<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 08.01.2017
 * Time: 16:23
 */

namespace app\modules\informationsystem\models;


use yii\db\ActiveQuery;

class GroupQuery extends ActiveQuery
{
    public function whereParentId($parentId)
    {
        return $this->where('parent_id = :parent_id', [':parent_id' => $parentId]);
    }

    public function whereInformationsystemId($id)
    {
        return $this->andWhere('informationsystem_id = :system_id', [':system_id' => $id]);
    }
}