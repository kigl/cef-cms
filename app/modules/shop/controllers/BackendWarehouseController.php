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
    protected $modelService;

    public function init()
    {
        parent::init();

        $this->modelService = Yii::createObject([
            'class' => WarehouseModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);
    }

    public function actionManager($shop_id)
    {
        $this->modelService->manager();

        return $this->render('manager', ['data' => $this->modelService->getData()]);
    }

    public function actionCreate($shop_id)
    {
        if ($this->modelService->create()) {
            return $this->redirect(['manager', 'shop_id' => $this->modelService->data['shop_id']]);
        }

        return $this->render('create', ['data' => $this->modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        if ($this->modelService->update()) {
            return $this->redirect(['manager', 'shop_id' => $this->modelService->data['shop_id']]);
        }

        return $this->render('update', ['data' => $this->modelService->getData()]);
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