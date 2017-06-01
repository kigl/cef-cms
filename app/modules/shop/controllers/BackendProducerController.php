<?php
/**
 * Class BackendProducerController
 * @package app\modules\shop\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers;


use Yii;
use app\modules\shop\models\backend\Producer;
use app\modules\shop\service\backend\ProducerModelService;
use app\modules\backend\controllers\Controller;

class BackendProducerController extends Controller
{
    protected $_modelService;

    public function init()
    {
        parent::init();

        $this->_modelService = Yii::createObject([
            'class' => ProducerModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);
    }

    public function actionCreate($shop_id, $group_id = null)
    {
        if ($this->_modelService->create()) {
            return $this->redirect([
                'backend-producer-group/manager',
                'shop_id' => $shop_id,
                'id' => $this->_modelService->data['model']->group_id
            ]);
        }

        return $this->render('create', ['data' => $this->_modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        if ($this->_modelService->update()) {
            return $this->redirect([
                'backend-producer-group/manager',
                'shop_id' => $this->_modelService->data['shop_id'],
                'id' => $this->_modelService->data['model']->group_id
            ]);
        }

        return $this->render('update', ['data' => $this->_modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Producer::findOne($id);

        if ($model->delete()) {
            return $this->redirect(['backend-producer-group/manager', 'shop_id' => $model->shop_id]);
        }

        return null;
    }
}