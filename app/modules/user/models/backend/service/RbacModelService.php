<?php
/**
 * Class RbacModelService
 * @package app\modules\user\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\models\backend\service;


use Yii;
use yii\data\ArrayDataProvider;
use yii\base\Model;
use app\core\service\ModelService;
use app\modules\user\components\RbacService;
use app\modules\user\models\backend\forms\RbacForm;

class RbacModelService extends ModelService
{
    protected $rbacService;

    protected $items = null;

    public function __construct(RbacService $rbacService, $config = [])
    {
        $this->rbacService = $rbacService;

        parent::__construct($config);
    }

    public function actionManager()
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => $this->rbacService->getItems(),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $modelForm = Yii::createObject([
            'class' => RbacForm::className(),
        ]);

        if ($modelForm->load($this->getData('post')) && $modelForm->validate()) {
            $item = $this->createRBACItem($modelForm);
            $this->rbacService->manager->add($item);
            $this->rbacService->saveChild($modelForm->child, $item);

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $modelForm,
        ]);
    }

    public function actionUpdate()
    {
        if (!$item = $this->rbacService->getItem($this->getData('get', 'type'), $this->getData('get', 'name'))) {
            $this->setError(self::ERROR_NOT_MODEL);
        }

        $modelForm = new RbacForm([
            'name' => $item->name,
            'description' => $item->description,
            'type' => $item->type,
            'child' => array_keys($this->rbacService->manager->getChildren($item->name)),
            'ruleName' => $item->ruleName,
        ]);

        if ($modelForm->load($this->getData('post')) && $modelForm->validate()) {
            $newItem = $this->createRBACItem($modelForm);
            $this->rbacService->manager->update($item->name, $newItem);
            $this->rbacService->saveChild($modelForm->child, $item);

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $modelForm,
        ]);
    }

    public function actionDelete($type, $name)
    {
        if ($item = $this->rbacService->getItem($type, $name)) {
            $this->rbacService->manager->remove($item);
            $this->rbacService->manager->removeChildren($item);

            $this->setExecutedAction(self::EXECUTED_ACTION_DELETE);
        }
    }

    protected function createRBACItem(Model $model)
    {
        return $this->rbacService->createItem(
            $model->type,
            $model->name,
            $model->description,
            $model->ruleName
        );
    }
}
