<?php
/**
 * Class BackendPackingController
 * @package app\modules\shop\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers;


use Yii;
use app\modules\shop\models\backend\Packing;
use app\modules\shop\service\backend\PackingModelService;
use app\modules\backend\controllers\Controller;

class BackendPackingController extends Controller
{
    protected $_modelService;

    public function init()
    {
        parent::init();

        $this->_modelService = Yii::createObject([
            'class' => PackingModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);
    }

    public function actionCreate($product_id)
    {
        if ($this->_modelService->create()) {
            return $this->redirect(['backend-product/update', 'id' => $product_id]);
        }

        return $this->render('create', ['data' => $this->_modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        if ($this->_modelService->update()) {
            return $this->redirect([
                'backend-product/update',
                'id' => $this->_modelService->data['product_id'],
            ]);
        }

        return $this->render('update', ['data' => $this->_modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Packing::findOne($id);

        if ($model->delete()) {
            return $this->redirect([
                'backend-product/update',
                'id' => $model->product->id,
            ]);
        }
    }
}