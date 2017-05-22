<?php

namespace app\modules\users\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\backend\controllers\Controller;
use app\modules\users\service\backend\UserModelService;
use app\modules\users\models\backend\User;

class BackendUserController extends Controller
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => 'app\modules\backend\actions\Delete',
                'modelClass' => '\app\modules\users\models\User',
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

        if ($modelService->create()) {
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

        if ($modelService->update()) {
            return $this->redirect(['manager']);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionView($id)
    {
        $modelService = Yii::createObject(UserModelService::class);
        $modelService->view($id);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', ['data' => $modelService->getData()]);
        }

        return $this->render('view', ['data' => $modelService->getData()]);
    }
}
