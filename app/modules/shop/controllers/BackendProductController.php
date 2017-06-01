<?php

namespace app\modules\shop\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\shop\service\backend\ProductModelService;

class BackendProductController extends Controller
{
    private $_modelService;

    public function init()
    {
        parent::init();

        $this->_modelService = Yii::createObject([
            'class' => ProductModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);
    }

    public function actionCreate($shop_id, $group_id = null, $parent_id = null)
    {
        if ($this->_modelService->create()) {

            return $this->redirect(['backend-product/update', 'id' => $this->_modelService->getData('model')->id]);
        }

        return $this->render('create', ['data' => $this->_modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        if ($this->_modelService->update()) {

            return $this->redirect(['backend-product/update', 'id' => $this->_modelService->getData('model')->id]);
        }

        return $this->render('update', ['data' => $this->_modelService->getData()]);
    }

    /*
     * @todo
     * Сделать удаление через post
     */
    public function actionDelete($id)
    {
        if ($this->_modelService->delete($id)) {

            return $this->redirect(['backend-product-group/manager', 'parent_id' => $this->_modelService->getData('groupId')]);
        }

        return false;
    }

    public function actionSelectionDelete()
    {
        if ($keys = Yii::$app->request->post('selection')) {
            foreach ($keys as $key) {
                $this->_modelService->delete($key);
            }
        }
    }
}
