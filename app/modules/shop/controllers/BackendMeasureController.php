<?php
/**
 * Class BackendMeasureController
 * @package app\modules\shop\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers;


use Yii;
use app\modules\shop\service\backend\MeasureModelService;
use app\modules\backend\actions\Delete;
use app\modules\backend\controllers\Controller;
use app\modules\shop\models\Measure;

class BackendMeasureController extends Controller
{
    public function action()
    {
        return [
            'delete' => [
                'class' => Delete::className(),
                'modelClass' => Measure::className(),
                'redirect' => ['backend-measure/manager'],
            ],
        ];
    }

    public function actionManager()
    {
        $modelService = Yii::createObject([
            'class' => MeasureModelService::className(),
        ]);

        $modelService->manager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate()
    {
        $modelService = Yii::createObject([
            'class' => MeasureModelService::className(),
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
            'class' => MeasureModelService::className(),
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);

        if ($modelService->update()) {
            return $this->redirect(['manager']);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }
}