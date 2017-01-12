<?php


namespace app\modules\user\components\rbac;


use yii\rbac\Item;

interface RbacServiceInterface
{
    public function add(Item $item);

    public function addChild(Item $parent, Item $child);

    public function remove(Item $item);

    public function assign();
}