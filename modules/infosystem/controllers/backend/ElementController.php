<?php
/**
 * Class ElementController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers\backend;


use Yii;
use app\modules\infosystem\components\BackendController;
use app\modules\infosystem\service\backend\ElementModelService;

class ElementController extends BackendController
{
    public function actionCreate($group_id = null, $infosystem_id)
    {
        $modelService = Yii::createObject([
            'class' => ElementModelService::class,
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
        $modelService = new ElementModelService();
        $modelService->actionUpdate([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);

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
        $modelService = Yii::createObject(ElementModelService::class);
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