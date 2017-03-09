<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.01.2017
 * Time: 19:06
 */

namespace app\modules\shop\controllers\backend;


use Yii;
use app\core\actions\Create;
use app\core\actions\Delete;
use app\core\actions\Update;
use app\modules\shop\components\BackendController;
use app\modules\shop\models\base\OrderField;
use app\modules\shop\service\backend\OrderModelService;
use app\modules\shop\service\backend\OrderViewService;

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