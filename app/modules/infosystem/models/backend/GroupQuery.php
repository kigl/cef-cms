<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 08.01.2017
 * Time: 16:23
 */

namespace app\modules\infosystem\models\backend;


use yii\db\ActiveQuery;

class GroupQuery extends ActiveQuery
{
    public function parentId($parentId)
    {
        return $this->where(['parent_id' => $parentId]);
    }

    public function infosystemId($id)
    {
        return $this->andWhere('infosystem_id = :system_id', [':system_id' => $id]);
    }

    public function byId($id)
    {
        return $this->where('id = :id', [':id' => $id]);
    }
}