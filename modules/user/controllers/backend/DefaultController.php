<?php

namespace app\modules\user\controllers\backend;


use app\modules\user\components\rbac\RbacService;
use Yii;
use yii\data\ActiveDataProvider;
use app\modules\user\service\backend\UserModelService;
use app\modules\user\service\backend\UserViewService;
use app\modules\user\components\BackendController;
use app\modules\user\models\UserService;
use app\modules\user\models\User;
use yii\rbac\Item;

class DefaultController extends BackendController
{

    public function actions()
    {
        return [
            'delete' => [
                'class' => 'app\core\actions\Delete',
                'model' => '\app\modules\user\models\User',
            ],
        ];
    }

    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'sort' => ['attributes' => ['id', 'login', 'email', 'status']],
        ]);
        return $this->render('manager', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $modelService = Yii::createObject(UserModelService::class);
        $modelService->actionCreate([
            'post' => Yii::$app->request->post(),
        ]);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['manager']);
        }

        $viewService = (new UserViewService())->setData($modelService->getData());

        return $this->render('create', ['data' => $viewService]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject(UserModelService::class);
        $modelService->actionUpdate([
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->post(),
        ]);

        $viewService = (new UserViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['default/manager']);
        }

        return $this->render('update', ['data' => $viewService]);
    }
}
