<?php
/**
 * Class InfosystemController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\controllers;


use yii;
use app\modules\infosystems\service\backend\InfosystemModelService;
use app\modules\backend\controllers\Controller;

class BackendInfosystemController extends Controller
{

    public function actionManager()
    {
        $modelService = Yii::createObject(InfosystemModelService::class);
        $modelService->manager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate()
    {
        $modelService = Yii::createObject([
            'class' => InfosystemModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
            ],
        ]);

        if ($modelService->create()) {
            return $this->redirect(['manager']);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', ['data' => $modelService->getData()]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject([
            'class' => InfosystemModelService::class,
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);

        if ($modelService->update()) {
            return $this->redirect(['manager']);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', ['data' => $modelService->getData()]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = Yii::createObject(InfosystemModelService::class);

        if ($modelService->delete($id)) {
            return $this->redirect(['manager']);
        }

        return false;
    }
}