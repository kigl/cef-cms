<?php

namespace app\modules\shop\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\shop\service\backend\ProductModelService;

class BackendProductController extends Controller
{
    public function actionCreate($shop_id, $group_id = null, $parent_id = null)
    {
        $modelService = Yii::createObject([
            'class' => ProductModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);

        if ($modelService->create()) {

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

        if ($modelService->update()) {

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

        if ($modelService->delete($id)) {

            return $this->redirect(['backend-group/manager', 'parent_id' => $modelService->getData('groupId')]);
        }

        return false;
    }

    public function actionSelectionDelete()
    {
        if ($keys = Yii::$app->request->post('selection')) {
            $modelService = new ProductModelService();

            foreach ($keys as $key) {
                $modelService->delete($key);
            }
        }
    }
}
