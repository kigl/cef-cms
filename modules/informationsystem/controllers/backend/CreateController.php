<?php

namespace app\modules\informationsystem\controllers\backend;


use Yii;
use app\modules\informationsystem\service\backend\ItemModelService;
use app\modules\informationsystem\service\backend\ItemViewService;
use app\modules\informationsystem\service\backend\GroupModelService;
use app\modules\informationsystem\service\backend\GroupViewService;
use app\modules\informationsystem\service\backend\TagModelService;
use app\modules\informationsystem\service\backend\TagViewService;
use app\modules\informationsystem\components\BackendController;

class CreateController extends BackendController
{
    public $defaultAction = 'system';

    public function actions()
    {
        return [
            'system' => [
                'class' => 'app\core\actions\Create',
                'model' => '\app\modules\informationsystem\models\Informationsystem',
                'view' => 'system',
                'redirect' => ['manager/system'],
            ],
        ];
    }

    public function actionGroup($informationsystem_id, $parent_id)
    {
        $modelService = new GroupModelService();
        $modelService->actionCreate([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        $viewService = (new GroupViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect([
                'manager/group',
                'id' => $modelService->getData('model')->id,
                'informationsystem_id' => $modelService->getData('model')->informationsystem_id,
            ]);
        }

        return $this->render('group', ['data' => $viewService]);
    }

    public function actionItem($group_id, $informationsystem_id)
    {
        $modelService = new ItemModelService();
        $modelService->actionCreate([
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

    public function actionTag($informationsystem_id)
    {
        $modelService = new TagModelService();
        $modelService->actionCreate([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        $viewService = (new TagViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'manager/tag',
                'informationsystem_id' => $modelService->getData('model')->informationsystem_id,
            ]);
        }

        return $this->render('tag', ['data' => $viewService]);
    }
}
