<?php
/**
 * Class BackendProducerGroupController
 * @package app\modules\shop\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers;


use Yii;
use app\modules\shop\service\backend\ProducerGroupModelService;
use app\modules\backend\controllers\Controller;

class BackendProducerGroupController extends Controller
{
    protected $_modelService;

    public function init()
    {
        parent::init();

        $this->_modelService = Yii::createObject([
            'class' => ProducerGroupModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => YiI::$app->request->post(),
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
                'shop_id' => $this->_modelService->data['model']->shop_id,
                'id' => $this->_modelService->data['model']->parent_id
            ]);
        }

        return $this->render('create', ['data' => $this->_modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        if ($this->_modelService->update()) {
            return $this->redirect([
                'manager',
                'shop_id' => $this->_modelService->data['model']->shop_id,
                'id' => $this->_modelService->data['model']->parent_id
            ]);
        }

        return $this->render('update', ['data' => $this->_modelService->getData()]);
    }

    public function actionDelete($id)
    {
        if ($this->_modelService->delete($id)) {
            return $this->redirect(['manager', 'shop_id' => $this->_modelService->data['model']->shop_id]);
        }

        return null;
    }
}