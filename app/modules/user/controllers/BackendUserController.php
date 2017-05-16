<?php

namespace app\modules\user\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\backend\controllers\Controller;
use app\modules\user\service\backend\UserModelService;
use app\modules\user\models\backend\User;

class BackendUserController extends Controller
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => 'app\modules\backend\actions\Delete',
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

        if ($modelService->actionCreate()) {
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

        if ($modelService->actionUpdate()) {
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
