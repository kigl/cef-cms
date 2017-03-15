<?php
/**
 * Class RbacService
 * @package app\modules\user\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\user\components;


use Yii;
use yii\base\Object;
use yii\rbac\Role;
use yii\rbac\Item;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class RbacService extends Object
{
    public $manager;

    protected $items;

    public function init()
    {
        parent::init();

        $this->manager = Yii::$app->authManager;
    }

    public function createItem($type, $name, $description = null, $ruleName = null)
    {
        if ($type == Role::TYPE_PERMISSION) {
            $item = $this->manager->createPermission($name);
            $item->description = $description === '' ? null : $description;
            $item->ruleName = $ruleName === '' ? null : $ruleName;

            return $item;
        } else {
            $item = $this->manager->createRole($name);
            $item->description = $description === '' ? null : $description;
            $item->ruleName = $ruleName === '' ? null : $ruleName;

            return $item;
        }
    }

    public function getItem($type, $name)
    {
        if ($type == Role::TYPE_ROLE) {
            return $this->manager->getRole($name);
        } else {
            return $this->manager->getPermission($name);
        }
    }

    public function getItems()
    {
        if (is_null($this->items)) {
            $this->items = ArrayHelper::merge($this->manager->getRoles(), $this->manager->getPermissions());
        }

        return $this->items;
    }

    public function saveChild(Model $model, Item $item)
    {
        if (is_array($model->child)) {
            $childNames = array_keys($this->manager->getChildren($item->name));

            // Удаляем
            foreach (array_diff($childNames, $model->child) as $child) {
                if ($this->manager->hasChild($item, $this->getItems()[$child])) {
                    $this->manager->removeChild($item, $this->getItems()[$child]);
                }
            }

            // Сохраняем
            foreach (array_diff($model->child, $childNames) as $child) {

                if (!empty($this->getItems()[$child])) { //если сужествует элемент
                    $childItem = $this->getItems()[$child];

                    if ($item->name != $childItem->name) { // если выбранное имя не равно текущему
                        if ($item->type == Role::TYPE_ROLE) {
                            $this->manager->addChild($item, $childItem);
                        } elseif ($childItem->type == Role::TYPE_ROLE) {
                            $this->manager->addChild($childItem, $item);
                        } else { // если оба елемента являются разрешением
                            $this->manager->addChild($item, $childItem);
                        }
                    }
                } else { // если не существует обнуляем вывод дочерних элементов
                    $model->child = null;
                }
            }

        } else {
            //$this->manager->removeChildren($element);
        }
    }

    public function saveUserAssignment($rolePermission, $userId)
    {
        if (is_array($rolePermission)) {
            $items = array_keys($this->manager->getAssignments($userId));

            foreach (array_diff($items, $rolePermission) as $item) {
                $role = $this->getItems()[$item];
                $this->manager->revoke($role, $userId);
            }

            $item = null;
            foreach (array_diff($rolePermission, $items) as $item) {
                if (!empty($this->getItems()[$item])) {
                    if ($role = $this->getItems()[$item]) {
                        $this->manager->assign($role, $userId);
                    }
                }
            }
        }
    }
}