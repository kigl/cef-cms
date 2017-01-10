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
        if ($type === Item::TYPE_ROLE) {
            $role = $this->authManager->createRole($name);
        } else if ($type === Item::TYPE_PERMISSION) {
            $role = $this->authManager->createPermission($name);
        }

        $role->description = $description;
        $role->ruleName = $rule ? $rule->name : null;
        $this->authManager->add($role);

        return $role;
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
}
