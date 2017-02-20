<?php
/**
 * Class GroupController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers\backend;


use Yii;
use app\modules\infosystem\components\BackendController;
use app\modules\infosystem\service\backend\GroupModelService;

class GroupController extends BackendController
{
    public function actionManager($id = null, $infosystem_id)
    {
        $modelService = Yii::createObject([
            'class' => GroupModelService::class,
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate($infosystem_id, $parent_id = null)
    {
        $modelService = Yii::createObject([
            'class' => GroupModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);
        $modelService->actionCreate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect([
                'manager',
                'id' => $modelService->getData('model')->id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject([
            'class' => GroupModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);
        $modelService->actionUpdate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'manager',
                'id' => $modelService->getData('model')->parent_id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {

            return $this->redirect([
                'manager',
                'id' => $modelService->getData('model')->parent_id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return false;
    }
}