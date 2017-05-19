<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.01.2017
 * Time: 19:06
 */

namespace app\modules\shop\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\shop\service\backend\OrderModelService;

class BackendOrderController extends Controller
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