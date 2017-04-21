<?php
/**
 * Class FormCopletedController
 * @package app\modules\service\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\form\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\form\models\backend\service\CompletedModelService;
use app\modules\form\models\backend\Completed;

class BackendCompletedController extends Controller
{
    public function actionManager($form_id)
    {
        $modelService = Yii::createObject(CompletedModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionView($id)
    {
        $modelService = Yii::createObject(CompletedModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
        ]);

        $modelService->actionView();

        return $this->render('view', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Completed::findOne($id);

        if ($model->delete()) {
            return $this->redirect(['manager', 'form_id' => $model->form_id]);
        }
    }
}