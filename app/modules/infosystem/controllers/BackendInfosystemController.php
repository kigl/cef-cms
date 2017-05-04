<?php
/**
 * Class InfosystemController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers;


use yii;
use app\modules\infosystem\service\backend\InfosystemModelService;
use app\modules\backend\controllers\Controller;

class BackendInfosystemController extends Controller
{

    public function actionManager()
    {
        $modelService = Yii::createObject(InfosystemModelService::class);
        $modelService->actionManager();

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

        if ($modelService->actionCreate()) {
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

        if ($modelService->actionUpdate()) {
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

        if ($modelService->actionDelete($id)) {
            return $this->redirect(['manager']);
        }

        return false;
    }
}