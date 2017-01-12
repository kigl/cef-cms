<?php

namespace app\modules\user\components\rbac;


use yii\rbac\DbManager;
use yii\rbac\Rule;
use yii\rbac\Item;
use yii\web\HttpException;

class RbacService implements RbacServiceInterface
{

    protected $authManager;

    public function __construct(
        DbManager $authManager
    )
    {
        $this->authManager = $authManager;
    }

    public function add(Item $item)
    {
        return $this->authManager->add($item);
    }

    public function addChild(Item $parent, Item $child)
    {
        return $this->authManager->addChild($parent, $child);
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

        if (!$item) {
            throw new HttpException(500);
        }

        $item->description = $description;
        $item->ruleName = $rule ? $rule->name : null;

        return $item;
    }

    public function update($name, Item $item)
    {
        return $this->authManager->update($name, $item);
    }

    public function remove(Item $item)
    {
        return $this->authManager->remove($item);
    }

    public function removeChildren(Item $parent)
    {
        return $this->authManager->removeChildren($parent);
    }

    public function removeChild(Item $parent, Item $child)
    {
        return $this->authManager->removeChild($parent, $child);
    }

    public function hasChild(Item $parent, Item $child)
    {
        return $this->authManager->hasChild($parent, $child);
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

    public function getChildren($parentName)
    {
        return $this->authManager->getChildren($parentName);
    }
}
