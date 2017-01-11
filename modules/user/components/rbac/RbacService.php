<?php

namespace app\modules\user\components\rbac;


use yii\rbac\DbManager;
use yii\rbac\Rule;
use yii\rbac\Item;

class RbacService implements RbacServiceInterface
{

    protected $authManager;

    public function __construct(
        DbManager $authManager
    )
    {
        $this->authManager = $authManager;
    }

    public function add(
        $name,
        $type = Item::TYPE_ROLE,
        $description = null,
        Rule $rule = null,
        $data = null
    )
    {
        $item = $this->createItem($name, $type, $description, $rule, $data);
        $this->authManager->add($this->createItem($item));

        return $item;
    }

    public function createItem(
        $name,
        $type = Item::TYPE_ROLE,
        $description = null,
        Rule $rule = null,
        $data = null
    )
    {
        if ($type === Item::TYPE_ROLE) {
            $item = $this->authManager->createRole($name);
        } else if ($type === Item::TYPE_PERMISSION) {
            $item = $this->authManager->createPermission($name);
        }

        $item->description = $description;
        $item->ruleName = $rule ? $rule->name : null;

        return $item;
    }

    public function update($name, $object)
    {
        return $this->authManager->update($name, $object);
    }
    
    public function addChild(Item $parent, Item $child)
    {
        return $this->authManager->addChild($parent, $child);
    }

    public function remove($object)
    {
        return $this->authManager->remove($object);
    }

    public function assign()
    {
        // TODO: Implement assign() method.
    }

    public function getItem($name)
    {
        $rMethod = new \ReflectionMethod(DbManager::class, 'getItem');
        $rMethod->setAccessible(true);

        return $rMethod->invoke($this->authManager, $name);
    }

    public function getItems($type)
    {
        $rMethod = new \ReflectionMethod(DbManager::class, 'getItems');
        $rMethod->setAccessible(true);

        return $rMethod->invoke($this->authManager, $type);
    }
}
