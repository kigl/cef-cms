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
use app\modules\user\models\RbacForm;
use app\core\service\ModelService;
use app\modules\user\components\rbac\RbacService;
use yii\base\Model;
use app\core\session\Flash;

class RbacModelService extends ModelService
{
    public function actionManager()
    {
        $rbacService = Yii::createObject(RbacService::class);

        $roleDataProvider = new ArrayDataProvider([
            'allModels' => $rbacService->getItems(Item::TYPE_ROLE),
        ]);

        $permissionDataProvider = new ArrayDataProvider([
            'allModels' => $rbacService->getItems(Item::TYPE_PERMISSION),
        ]);

        $this->setData([
            'roleDataProvider' => $roleDataProvider,
            'permissionDataProvider' => $permissionDataProvider,
        ]);
    }

    public function actionCreate($params)
    {
        $modelForm = new RbacForm();
        $modelForm->type = $params['get']['type'];


        $modelForm->on($modelForm::EVENT_BEFORE_VALIDATE, function ($event) {
            Yii::$app->session->setFlash(Flash::FLASH_SUCCESS, Yii::t('app', 'Created element'));
        });

        if ($modelForm->load($params['post']) &&  $modelForm->validate()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_VALIDATE);
        }

        if ($this->hasExecutedAction(self::EXECUTED_ACTION_VALIDATE)) {
            $this->addItem($modelForm);

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $modelForm,
        ]);
    }

    public function actionUpdate(array $params)
    {

    }

    protected function addItem(Model $model)
    {
        $rbacService = Yii::createObject(RbacService::class);

        $rbacService->add(
            $model->name,
            $model->type,
            $model->description
        );
    }
}