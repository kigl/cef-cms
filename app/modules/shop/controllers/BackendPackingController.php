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
    public $modelService;

    public function init()
    {
        parent::init();

        $this->modelService = Yii::createObject([
            'class' => PackingModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);
    }

    public function actionCreate($product_id)
    {
        if ($this->modelService->create()) {
            return $this->redirect(['backend-product/update', 'id' => $product_id, '#' => 'packing']);
        }

        return $this->render('create', ['data' => $this->modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        if ($this->modelService->update()) {
            return $this->redirect([
                'backend-product/update',
                'id' => $this->modelService->data['product_id'],
                '#' => 'packing'
            ]);
        }

        return $this->render('update', ['data' => $this->modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Packing::findOne($id);

        if ($model->delete()) {
            return $this->redirect([
                'backend-product/update',
                'id' => $model->product->id,
                '#' => 'packing'
            ]);
        }
    }
}