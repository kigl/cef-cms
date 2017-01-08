<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.01.2017
 * Time: 19:06
 */

namespace app\modules\shop\controllers\backend;


use app\core\actions\Create;
use app\core\actions\Delete;
use app\core\actions\Update;
use app\modules\shop\components\BackendController;
use app\modules\shop\models\base\OrderField;
use app\modules\shop\service\backend\OrderModelService;
use app\modules\shop\service\backend\OrderViewService;

class OrderController extends BackendController
{
    public function actions()
    {
        return [
            'field-create' => [
                'class' => Create::className(),
                'model' => OrderField::className(),
                'view' => 'field/create',
                'redirect' => 'field-manager',
            ],
            'field-update' => [
                'class' => Update::className(),
                'model' => OrderField::className(),
                'view' => 'field/update',
                'redirect' => 'field-manager',
            ],
            'field-delete' => [
                'class' => Delete::className(),
                'model' => OrderField::className(),
                'redirect' => ['field-manager'],
            ],
        ];
    }

    public function actionFieldManager()
    {
        $modelService = new OrderModelService();
        $modelService->actionFieldManager();

        $viewService = (new OrderViewService())->setData($modelService->getData());

        return $this->render('field/manager', ['data' => $viewService]);
    }
    
    public function actionFieldUpdate($id)
    {
        
    }
    
    public function actionFieldDelete($id)
    {
        
    }
}