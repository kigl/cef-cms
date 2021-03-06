<?php
/**
 * Class BackendWarehouseController
 * @package app\modules\shop\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers;


use app\modules\shop\models\backend\Warehouse;
use Yii;
use app\modules\shop\service\backend\WarehouseModelService;
use app\modules\backend\controllers\Controller;

class BackendWarehouseController extends Controller
{
    protected $_modelService;

    public function init()
    {
        parent::init();

        $this->_modelService = Yii::createObject([
            'class' => WarehouseModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);
    }

    public function actionManager($shop_id)
    {
        $this->_modelService->manager();

        return $this->render('manager', ['data' => $this->_modelService->getData()]);
    }

    public function actionCreate($shop_id)
    {
        if ($this->_modelService->create()) {
            return $this->redirect(['manager', 'shop_id' => $this->_modelService->data['shop_id']]);
        }

        return $this->render('create', ['data' => $this->_modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        if ($this->_modelService->update()) {
            return $this->redirect(['manager', 'shop_id' => $this->_modelService->data['shop_id']]);
        }

        return $this->render('update', ['data' => $this->_modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Warehouse::findOne($id);

        if ($model->delete()) {
            return $this->redirect(['manager', 'shop_id' => $model->shop_id]);
        }

        return null;
    }
}