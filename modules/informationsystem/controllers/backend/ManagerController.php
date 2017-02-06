<?php

namespace app\modules\informationsystem\controllers\backend;


use app\modules\informationsystem\service\backend\ItemModelService;
use app\modules\informationsystem\service\backend\TagModelService;
use Yii;
use app\modules\informationsystem\components\BackendController;
use app\modules\informationsystem\service\backend\InformationSystemModelService;
use app\modules\informationsystem\service\backend\InformationSystemViewService;
use app\modules\informationsystem\service\backend\GroupModelService;
use app\modules\informationsystem\service\backend\GroupViewService;

class ManagerController extends BackendController
{
    public $defaultAction = 'system';

    public function actionSystem()
    {
        $modelService = Yii::createObject(InformationSystemModelService::class);
        $modelService->actionManager();

        $viewService = Yii::createObject(InformationSystemViewService::class)->setData($modelService->getData());

        return $this->render('system', ['data' => $viewService]);
    }

    public function actionGroup($id, $informationsystem_id)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->actionManager(Yii::$app->request->getQueryParams());

        $viewService = (new GroupViewService())->setData($modelService->getData());

        return $this->render('group', ['data' => $viewService]);
    }

    public function actionTag()
    {
        $modelService = Yii::createObject(TagModelService::class);
        $modelService->actionManager();

        return $this->render('tag', ['data' => $modelService->getData()]);
    }
}
