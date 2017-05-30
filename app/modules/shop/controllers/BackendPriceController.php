<?php
/**
 * Class BackendPriceController
 * @package app\modules\shop\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers;


use app\modules\shop\service\backend\PriceModelService;
use Yii;
use app\modules\backend\controllers\Controller;

class BackendPriceController extends Controller
{
    public function actionManager($shop_id)
    {
        $modelService = Yii::createObject([
            'class' => PriceModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);

        $modelService->manager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate($shop_id)
    {
        $modelService = Yii::createObject([
            'class' => PriceModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);

        if ($modelService->create()) {
            return $this->redirect(['manager', 'shop_id' => $shop_id]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject([
            'class' => PriceModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);

        if ($modelService->update()) {
            return $this->redirect(['manager', 'shop_id' => $modelService->data['model']->shop_id]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }
}