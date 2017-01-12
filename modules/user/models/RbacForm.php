<?php
/**
 * Class RbacForm
 * @package app\modules\user\models
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\models;


use Yii;
use yii\base\Model;
use yii\rbac\Item;
use app\modules\user\components\rbac\RbacService;
use app\core\session\Flash;

class RbacForm extends Model
{
    public $name;

    public $child;

    public $type;

    public $description;

    public $rule;

    public $data;

    public $item = null;

    protected $rbacService;

    public function __construct(RbacService $rbacService, $config = [])
    {
        $this->rbacService = $rbacService;
        parent::__construct($config);
    }

    public function init()
    {
        if ($this->item instanceof Item) {
            $this->name = $this->item->name;
            $this->type = $this->item->type;
            $this->description = $this->item->description;
            $this->child = array_keys(Yii::createObject(RbacService::class)->getChildren($this->name));
        }

        $this->on(self::EVENT_BEFORE_VALIDATE, function ($event) {
            Yii::$app->session->setFlash(Flash::FLASH_SUCCESS, Yii::t('app', 'Created element'));
        });

        parent::init();
    }

    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name', 'description'], 'string', 'max' => 255],
            ['type', 'validatorType'],
            ['child', 'safe'],
        ];
    }

    public function validatorType($attribute)
    {
        if ($this->$attribute == Item::TYPE_ROLE) {
            $this->$attribute = Item::TYPE_ROLE;
        } else {
            if ($this->$attribute == Item::TYPE_PERMISSION) {
                $this->$attribute = Item::TYPE_PERMISSION;
            } else {
                $this->addError($attribute, Yii::t('user', 'Rbac form error message type'));
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('user', 'Rbac form name'),
            'child' => Yii::t('user', 'Rbac form child'),
            'type' => Yii::t('user', 'Rbac form type'),
            'description' => Yii::t('user', 'Rbac form description'),
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        if (!$item = $this->item) {
            $item = $this->createItem();

            $this->rbacService->add($item);

            $this->saveChild($item);
        } else {
            $newItem = $this->createItem();
            $this->rbacService->update($item->name, $newItem);

            $this->saveChild($newItem);
        }

        return true;
    }

    protected function saveChild(Item $item)
    {
        $oldChild = $this->rbacService->getChildren($item->name);
        $oldChildNames = array_keys($oldChild);

        if (is_array($this->child)) {
            foreach (array_diff($oldChildNames, $this->child) as $child) {
                if ($this->rbacService->hasChild($item, $this->rbacService->getItem($child))) {
                    $this->rbacService->removeChild($item, $this->rbacService->getItem($child));
                }
            }

            foreach (array_diff($this->child, $oldChildNames) as $child) {
                $childItem = $this->rbacService->getItem($child);

                if ($childItem && ($item->name != $childItem->name)) {
                    $this->rbacService->addChild($item, $childItem);
                } else {
                    $this->child = null;
                }
            }
        } else {
            $this->rbacService->removeChildren($item);
        }
    }

    protected function createItem()
    {
        $item = $this->rbacService->createItem(
            $this->name,
            $this->type,
            $this->description
        );

        return $item;
    }
}
