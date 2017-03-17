<?php
/**
 * Class ItemController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\infosystem\controllers\backend;


use Yii;
use kigl\cef\module\infosystem\components\BackendController;
use kigl\cef\module\infosystem\service\backend\ItemModelService;

class ItemController extends BackendController
{
    public function actionCreate($group_id = null, $infosystem_id)
    {
        $modelService = Yii::createObject([
            'class' => ItemModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);
        $modelService->actionCreate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect([
                'group/manager',
                'id' => $modelService->getData('model')->group_id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject([
            'class' => ItemModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);
        $modelService->actionUpdate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'group/manager',
                'id' => $modelService->getData('model')->group_id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = Yii::createObject(ItemModelService::class);
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {

            return $this->redirect([
                'group/manager',
                'id' => $modelService->getData('model')->group_id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return false;
    }
}