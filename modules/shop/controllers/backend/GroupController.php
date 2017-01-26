<?php

namespace app\modules\shop\controllers\backend;

use app\modules\shop\service\backend\GroupModelService;
use app\modules\shop\service\backend\GroupViewService;
use Yii;
use app\modules\shop\components\BackendController;
use app\modules\shop\models\GroupSearch;
use app\modules\shop\models\Group;
use app\modules\shop\models\ProductSearch;

class GroupController extends BackendController
{

    public function actionManager($parent_id = 0)
    {
        $dataProviderSearch = new GroupSearch();
        $dataProviderGroup = $dataProviderSearch->search($parent_id, Yii::$app->request->getQueryParams());
        $dataProviderProductSearch = new ProductSearch();
        $dataProviderProduct = $dataProviderProductSearch->search($parent_id, Yii::$app->request->getQueryParams());

        return $this->render('manager', [
            'parent_id' => $parent_id,
            'dataProviderGroup' => $dataProviderGroup,
            'dataProviderProduct' => $dataProviderProduct,
        ]);
    }

    public function actionCreate($parent_id)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->actionCreate([
            'post' => Yii::$app->request->post(),
            'parentId' => $parent_id,
        ]);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['manager', 'parent_id' => $modelService->getData('parentId')]);
        }

        $viewService = (new GroupViewService())->setData($modelService->getData());

        return $this->render('create', ['data' => $viewService]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->actionUpdate([
            'post' => Yii::$app->request->post(),
            'id' => $id,
        ]);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect(['manager', 'parent_id' => $modelService->getData('parentId')]);
        }

        $viewService = (new GroupViewService())->setData($modelService->getData());

        return $this->render('update', ['data' => $viewService]);
    }

    public function actionDelete($id)
    {
        $modelService = new GroupModelService();
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {

            return $this->redirect(['group/manager', 'parent_id' => $modelService->getData('parentId')]);
        }

        return false;
    }
}