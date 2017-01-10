<?php


namespace app\modules\user\components\rbac;


use yii\rbac\BaseManager;
use yii\rbac\Rule;
use yii\rbac\Item;

interface RbacServiceInterface
{
    public function add($name, $type, $description, Rule $rule, $data);

    public function addChild(Item $parent, Item $child);

    public function remove($item);

    public function assign();
}