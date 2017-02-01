<?php

namespace app\modules\informationsystem\controllers\backend;


use Yii;
use app\modules\informationsystem\components\BackendController;
use app\modules\informationsystem\service\backend\InformationSystemModelService;
use app\modules\informationsystem\service\backend\InformationSystemViewService;
use app\modules\informationsystem\service\backend\GroupModelService;
use app\modules\informationsystem\service\backend\GroupViewService;
use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\models\Tag;
use app\modules\informationsystem\models\TagSearch;

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

    public function actionTag($informationsystem_id)
    {
        $model = new TagSearch;

        $dataProvider = $model->search(Yii::$app->request->getQueryParams());

        return $this->render('tag', [
            'dataProvider' => $dataProvider,
            'searchModel' => $model,
            'informationsystem_id' => $informationsystem_id,
        ]);
    }
}
