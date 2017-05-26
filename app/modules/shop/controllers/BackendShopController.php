<?php
/**
 * Class BckendShopController
 * @package app\modules\shop\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers;


use Yii;
use app\modules\shop\service\backend\ShopModelService;
use app\modules\backend\controllers\Controller;

class BackendShopController extends Controller
{
    public function actionManager()
    {
        $modelService = Yii::createObject(ShopModelService::className());

        $modelService->manager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate()
    {
        $modelService = Yii::createObject([
            'class' => ShopModelService::className(),
            'data' => [
                'post' => Yii::$app->request->post(),
            ],
        ]);

        if ($modelService->create()) {
            return $this->redirect(['manager']);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject([
            'class' => ShopModelService::className(),
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->get(),
            ],
        ]);

        if ($modelService->update()) {
            return $this->redirect(['manager']);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }
}