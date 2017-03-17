<?php
/**
 * Class InfosystemController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\infosystem\controllers\backend;


use yii;
use kigl\cef\module\infosystem\service\backend\InfosystemModelService;
use kigl\cef\module\infosystem\components\BackendController;

class InfosystemController extends BackendController
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
        $modelService->actionCreate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['group/manager', 'infosystem_id' => $modelService->getData('model')->id]);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', ['data' => $modelService->getData()]);
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
        $modelService->actionUpdate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['group/manager', 'infosystem_id' => $modelService->getData('model')->id]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = Yii::createObject(InfosystemModelService::class);
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {
            return $this->redirect(['manager']);
        }

        return false;
    }
}