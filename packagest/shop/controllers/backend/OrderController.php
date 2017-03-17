<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.01.2017
 * Time: 19:06
 */

namespace kigl\cef\module\shop\controllers\backend;


use Yii;
use kigl\cef\module\shop\components\BackendController;
use kigl\cef\module\shop\models\base\OrderField;
use kigl\cef\module\shop\service\backend\OrderModelService;
use kigl\cef\module\shop\service\backend\OrderViewService;

class OrderController extends BackendController
{

    public function actionManager()
    {
        $modelService = Yii::createObject(OrderModelService::class);
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionView($id)
    {
        $modelService = Yii::createObject(OrderModelService::class);
        $modelService->actionView($id);

        return $this->render('view', ['data' => $modelService->getData()]);
    }
}