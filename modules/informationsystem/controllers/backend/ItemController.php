<?php
/**
 * Class ItemController
 * @package app\modules\informationsystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\controllers\backend;


use Yii;
use app\modules\informationsystem\components\BackendController;
use app\modules\informationsystem\service\backend\ItemModelService;

class ItemController extends BackendController
{
    public function actionCreate($group_id = null, $informationsystem_id)
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
                'informationsystem_id' => $modelService->getData('model')->informationsystem_id,
            ]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = new ItemModelService();
        $modelService->actionUpdate([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'group/manager',
                'id' => $modelService->getData('model')->group_id,
                'informationsystem_id' => $modelService->getData('model')->informationsystem_id,
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
                'informationsystem_id' => $modelService->getData('model')->informationsystem_id,
            ]);
        }

        return false;
    }
}