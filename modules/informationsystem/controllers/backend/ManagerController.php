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
        $modelTag = new Tag;

        if ($modelTag->load(Yii::$app->request->post()) and $modelTag->save()) {
            $modelTag = new Tag;
        }

        $model = new TagSearch;
        $system = System::getSystem($informationsystem_id);

        $dataProvider = $model->search($informationsystem_id, Yii::$app->request->getQueryParams());

        return $this->render('tag', [
            'dataProvider' => $dataProvider,
            'searchModel' => $model,
            'system' => $system,
            'informationsystem_id' => $informationsystem_id,
            'breadcrumbs' => Group::buildBreadcrumbs(null, $informationsystem_id),
            'modelTag' => $modelTag,
        ]);
    }
}
