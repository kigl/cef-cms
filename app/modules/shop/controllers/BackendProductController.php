<?php

namespace app\modules\shop\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\shop\models\backend\service\ProductModelService;

class BackendProductController extends Controller
{
    public function actionCreate($group_id = null, $parent_id = null)
    {
        $modelService = Yii::createObject([
            'class' => ProductModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);

        if ($modelService->actionCreate()) {

            return $this->redirect(['backend-product/update', 'id' => $modelService->getData('model')->id]);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', ['data' => $modelService->getData()]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject([
            'class' => ProductModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);

        if ($modelService->actionUpdate()) {

            return $this->redirect(['backend-product/update', 'id' => $modelService->getData('model')->id]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    /*
     * @todo
     * Сделать удаление через post
     */
    public function actionDelete($id)
    {
        $modelService = new ProductModelService();

        if ($modelService->actionDelete($id)) {

            return $this->redirect(['backend-group/manager', 'parent_id' => $modelService->getData('groupId')]);
        }

        return false;
    }

    public function actionSelectionDelete()
    {
        if ($keys = Yii::$app->request->post('selection')) {
            $modelService = new ProductModelService();

            foreach ($keys as $key) {
                $modelService->actionDelete($key);
            }
        }
    }
}
