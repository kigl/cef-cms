<?php
/**
 * Class RbacActionService
 * @package app\modules\user\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\service\backend;


use app\modules\user\components\rbac\RbacService;
use yii\base\Model;
use yii\rbac\Item;

class RbacActionService
{
    protected $rbacService;

    public $item = null;

    public $data = null;

    public function __construct(RbacService $rbacService)
    {
        $this->rbacService = $rbacService;
    }

    public function add()
    {
        if ($item = $this->createItem()) {

            $this->rbacService->add($item);

            $this->saveChild($item);
        }
    }

    public function update()
    {
        if ($this->item instanceof Item && ($newItem = $this->createItem())) {
            $this->rbacService->update($this->item->name, $newItem);
            $this->saveChild($newItem);

            return true;
        }

        return false;
    }

    protected function saveChild(Item $item)
    {
        if ($this->data instanceof Model && (is_array($this->data->child))) {
            $oldChild = $this->rbacService->getChildren($item->name);
            $oldChildNames = array_keys($oldChild);

            foreach (array_diff($oldChildNames, $this->data->child) as $child) {
                if ($this->rbacService->hasChild($item, $this->rbacService->getItem($child))) {
                    $this->rbacService->removeChild($item, $this->rbacService->getItem($child));
                }
            }

            foreach (array_diff($this->data->child, $oldChildNames) as $child) {
                $childItem = $this->rbacService->getItem($child);

                if ($childItem && ($item->name != $childItem->name)) {
                    $this->rbacService->addChild($item, $childItem);
                } else {
                    $this->data->child = null;
                }
            }
        } else {
            $this->rbacService->removeChildren($item);
        }
    }

    protected function createItem()
    {
        if ($this->data instanceof Model) {
            $item = $this->rbacService->createItem(
                $this->data->name,
                $this->data->type,
                $this->data->description
            );

            return $item;
        }

        return false;
    }
}