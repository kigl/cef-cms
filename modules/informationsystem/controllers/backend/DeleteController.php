<?php

namespace app\modules\informationsystem\controllers\backend;


use Yii;
use app\modules\informationsystem\components\BackendController;
use app\modules\informationsystem\service\backend\ItemModelService;
use app\modules\informationsystem\service\backend\GroupModelService;
use app\modules\informationsystem\service\backend\InformationSystemModelService;
use app\modules\informationsystem\models\Tag;
use app\modules\informationsystem\models\TagRelations;

class DeleteController extends BackendController
{

    public function actionSystem($id)
    {
        $modelService = Yii::createObject(InformationSystemModelService::class);
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {
            return $this->redirect(['manager/system']);
        }

        return false;
    }

    public function actionGroup($id)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {

                return $this->redirect([
                    'manager/group',
                    'id' => $modelService->getData('model')->parent_id,
                    'informationsystem_id' => $modelService->getData('model')->informationsystem_id,
                ]);
        }

        return false;
    }

    public function actionItem($id)
    {
        $modelService = Yii::createObject(ItemModelService::class);
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {

            return $this->redirect([
                'manager/group',
                'id' => $modelService->getData('model')->group_id,
                'informationsystem_id' => $modelService->getData('model')->informationsystem_id,
            ]);
        }

        return false;
    }

    public function actionTag($id)
    {
        $model = Tag::findOne($id);

        if ($model->delete()) {
            TagRelations::deleteAll("tag_id = {$model->id}");

            return $this->redirect(['manager/tag', 'informationsystem_id' => $model->informationsystem_id]);
        }

        return false;
    }
}