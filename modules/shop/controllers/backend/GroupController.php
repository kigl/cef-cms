<?php

namespace app\modules\shop\controllers\backend;


use Yii;
use app\modules\shop\service\backend\GroupModelService;
use app\modules\shop\service\backend\GroupViewService;
use app\modules\shop\components\BackendController;
use app\modules\shop\models\GroupSearch;
use app\modules\shop\models\ProductSearch;

class GroupController extends BackendController
{

    public function actionManager($id = 0)
    {
        $dataProviderSearch = new GroupSearch();
        $dataProviderGroup = $dataProviderSearch->search($id, Yii::$app->request->getQueryParams());
        $dataProviderProductSearch = new ProductSearch();
        $dataProviderProduct = $dataProviderProductSearch->search($id, Yii::$app->request->getQueryParams());

        return $this->render('manager', [
            'id' => $id,
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

            return $this->redirect(['manager', 'id' => $modelService->getData('model')->id]);
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

            return $this->redirect(['manager', 'id' => $modelService->getData('model')->parent_id]);
        }

        $viewService = (new GroupViewService())->setData($modelService->getData());

        return $this->render('update', ['data' => $viewService]);
    }

    public function actionDelete($id)
    {
        $modelService = new GroupModelService();
        $modelService->actionDelete($id);
        
        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {

            return $this->redirect(['group/manager', 'id' => $modelService->getData('model')->parent_id]);
        }


        return false;
    }
}