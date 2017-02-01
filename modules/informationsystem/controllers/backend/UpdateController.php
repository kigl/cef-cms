<?php

namespace app\modules\informationsystem\controllers\backend;


use Yii;
use app\modules\informationsystem\components\BackendController;
use app\modules\informationsystem\service\backend\ItemModelService;
use app\modules\informationsystem\service\backend\ItemViewService;
use app\modules\informationsystem\service\backend\TagModelService;
use app\modules\informationsystem\service\backend\TagViewService;
use app\modules\informationsystem\service\backend\GroupModelService;
use app\modules\informationsystem\service\backend\GroupViewService;

class UpdateController extends BackendController
{
    public $defaultAction = 'system';

    public function actions()
    {
        return [
            'system' => [
                'class' => 'app\core\actions\Update',
                'model' => '\app\modules\informationsystem\models\Informationsystem',
                'view' => 'system',
                'redirect' => ['manager/system'],
            ],
        ];
    }

    public function actionGroup($id)
    {
        $modelService = new GroupModelService();
        $modelService->actionUpdate([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        $viewService = (new GroupViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'manager/group',
                'id' => $modelService->getData('model')->parent_id,
                'informationsystem_id' => $modelService->getData('model')->informationsystem_id,
            ]);
        }

        return $this->render('group', ['data' => $viewService]);
    }

    public function actionItem($id)
    {
        $modelService = new ItemModelService();
        $modelService->actionUpdate([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        $viewService = (new ItemViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'manager/group',
                'id' => $modelService->getData('model')->group_id,
                'informationsystem_id' => $modelService->getData('model')->informationsystem_id,
            ]);
        }

        return $this->render('item', ['data' => $viewService]);
    }

    public function actionTag($id)
    {
        $modelService = new TagModelService();
        $modelService->actionUpdate([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        $viewService = (new TagViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'manager/tag',
                'informationsystem_id' => $modelService->getData('model')->informationsystemId,
            ]);
        }

        return $this->render('tag', ['data' => $viewService]);
    }
}
