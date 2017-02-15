<?php
/**
 * Class RbacModelService
 * @package app\modules\user\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\service\backend;


use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use app\core\service\ModelService;
use app\modules\user\models\forms\RbacForm;
use app\modules\user\components\rbac\RbacService;

class RbacModelService extends ModelService
{
    protected $rbacService;

    public function __construct()
    {
        $this->rbacService = Yii::$app->authManager;
    }

    public function actionManager()
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => ArrayHelper::merge(
                $this->rbacService->getRoles(),
                $this->rbacService->getPermissions()
            ),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
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
        ]);
    }
}