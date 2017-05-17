<?php

namespace app\modules\shop\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\shop\service\backend\GroupModelService;

class BackendGroupController extends Controller
{

    public function actionManager($id = null)
    {
        $modelService = Yii::createObject(GroupModelService::class)
            ->setData([
                'get' => Yii::$app->request->getQueryParams(),
            ]);
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate($parent_id = null)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        if ($modelService->actionCreate()) {

            return $this->redirect(['manager', 'id' => $modelService->getData('model')->parent_id]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        if ($modelService->actionUpdate()) {

            return $this->redirect(['manager', 'id' => $modelService->getData('model')->parent_id]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = new GroupModelService();

        if ($modelService->actionDelete($id)) {

            return $this->redirect(['backend-group/manager', 'id' => $modelService->getData('model')->parent_id]);
        }

        return false;
    }

    public function actionSelectionDelete()
    {
        if ($keys = Yii::$app->request->post('selection')) {
            $modelService = new GroupModelService();

            foreach ($keys as $key) {
                $modelService->actionDelete($key);
            }
        }
    }
}