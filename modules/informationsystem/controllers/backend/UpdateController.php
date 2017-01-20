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
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->actionUpdate();

        $viewService = (new GroupViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'manager/group',
                'parent_id' => $modelService->getData('parentId'),
                'informationsystem_id' => $modelService->getData('informationsystemId'),
            ]);
        }

        return $this->render('group', ['data' => $viewService]);
    }

    public function actionItem($id)
    {
        $modelService = new ItemModelService();
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->actionUpdate();

        $viewService = (new ItemViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'manager/group',
                'parent_id' => $modelService->getData('groupId'),
                'informationsystem_id' => $modelService->getData('informationsystemId'),
            ]);
        }

        return $this->render('item', ['data' => $viewService]);
    }

    public function actionTag($id)
    {
        $modelService = new TagModelService();
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->actionUpdate();

        $viewService = (new TagViewService())->setData($modelService->getData());

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'manager/tag',
                'informationsystem_id' => $modelService->getData('informationsystemId'),
            ]);
        }

        return $this->render('tag', ['data' => $viewService]);
    }
}
