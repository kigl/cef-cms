<?php

namespace app\modules\shop\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\shop\service\backend\ProductGroupModelService;

class BackendProductGroupController extends Controller
{
    private $_modelService;

    public function init()
    {
        parent::init();

        $this->_modelService = Yii::createObject([
            'class' => ProductGroupModelService::className(),
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);
    }

    public function actionManager($shop_id, $id = null)
    {
        $this->_modelService->manager();

        return $this->render('manager', ['data' => $this->_modelService->getData()]);
    }

    public function actionCreate($shop_id, $parent_id = null)
    {
        if ($this->_modelService->create()) {

            return $this->redirect([
                'manager',
                'id' => $this->_modelService->getData('model')->parent_id,
                'shop_id' => $this->_modelService->getData('model')->shop_id,
            ]);
        }

        return $this->render('create', ['data' => $this->_modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        if ($this->_modelService->update()) {

            return $this->redirect([
                'manager',
                'id' => $this->_modelService->getData('model')->parent_id,
                'shop_id' => $this->_modelService->getData('model')->shop_id,
            ]);
        }

        return $this->render('update', ['data' => $this->_modelService->getData()]);
    }

    public function actionDelete($id)
    {
        if ($this->_modelService->delete($id)) {

            return $this->redirect([
                'manager',
                'id' => $this->_modelService->getData('model')->parent_id,
                'shop_id' => $this->_modelService->getData('model')->shop_id,
            ]);
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