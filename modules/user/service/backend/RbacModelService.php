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

    public function actionCreate($params)
    {
        $modelForm = Yii::createObject(RbacForm::className());
        $modelForm->type = $params['type'];

        if ($modelForm->load($params['post']) &&  $modelForm->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_VALIDATE);
        }

        $this->setData([
            'model' => $modelForm,
            'items' => $this->rbacService->getItems($params['type']),
        ]);
    }

    public function actionUpdate(array $params)
    {
        $modelForm = Yii::createObject([
            'class' => RbacForm::className(),
            'item' => $this->rbacService->getItem($params['name']),
        ]);

        if ($modelForm->load($params['post']) &&  $modelForm->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_VALIDATE);
        }

        $this->setData([
            'model' => $modelForm,
            'items' => $this->rbacService->getItems($modelForm->type),
        ]);
    }
}