<?php
/**
 * Class RbacModelService
 * @package app\modules\user\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\service\backend;


use Yii;
use yii\rbac\Item;
use yii\data\ArrayDataProvider;
use app\core\service\ModelService;
use app\modules\user\models\RbacForm;
use app\modules\user\components\rbac\RbacService;

class RbacModelService extends ModelService
{
    protected $rbacService;

    public function __construct(RbacService $rbacService)
    {
        $this->rbacService = $rbacService;
    }

    public function actionManager()
    {
        $roleDataProvider = new ArrayDataProvider([
            'allModels' => $this->rbacService->getItems(Item::TYPE_ROLE),
        ]);

        $permissionDataProvider = new ArrayDataProvider([
            'allModels' => $this->rbacService->getItems(Item::TYPE_PERMISSION),
        ]);

        $this->setData([
            'roleDataProvider' => $roleDataProvider,
            'permissionDataProvider' => $permissionDataProvider,
        ]);
    }

    public function actionCreate($data = [], $type)
    {
        $modelForm = Yii::createObject([
            'class' => RbacForm::className(),
            'type' => $type,
        ]);

        if ($modelForm->load($data) &&  $modelForm->validate()) {
            Yii::createObject([
                'class' => RbacActionService::class,
                'data' => $modelForm,
            ])->add();

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $modelForm,
            'items' => $this->rbacService->getItems($type),
        ]);
    }

    public function actionUpdate($name, $data = [])
    {
        $item = $this->rbacService->getItem($name);

        $modelForm = Yii::createObject([
            'class' => RbacForm::className(),
            'name' => $item->name,
            'description' => $item->description,
            'type' => $item->type,
            'child' => array_keys(Yii::createObject(RbacService::class)->getChildren($item->name)),
        ]);

        if ($modelForm->load($data) &&  $modelForm->validate()) {
            // логика обновления
            Yii::createObject([
                'class' => RbacActionService::class,
                'item' => $item,
                'data' => $modelForm,
            ])->update();

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'item' => $item,
            'model' => $modelForm,
            'items' => $this->rbacService->getItems($item->type),
        ]);
    }
}