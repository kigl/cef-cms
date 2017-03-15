<?php

namespace kigl\cef\module\user\controllers\backend;


use Yii;
use yii\data\ActiveDataProvider;
use kigl\cef\module\user\service\backend\UserModelService;
use kigl\cef\module\user\components\BackendController;
use kigl\cef\module\user\models\UserService;
use kigl\cef\module\user\models\User;

class UserController extends BackendController
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => 'app\core\actions\Delete',
                'modelClass' => '\app\modules\user\models\User',
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
        $modelService = Yii::createObject([
            'class' => UserModelService::class,
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);
        $modelService->actionCreate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['manager']);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject([
            'class' => UserModelService::class,
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);
        $modelService->actionUpdate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['manager']);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionView($id)
    {
        $modelService = Yii::createObject(UserModelService::class);
        $modelService->actionView($id);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', ['data' => $modelService->getData()]);
        }

        return $this->render('view', ['data' => $modelService->getData()]);
    }
}
