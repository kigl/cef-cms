<?php
/**
 * Class InfosystemController
 * @package app\modules\infosystem\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\controllers;

use Yii;
use app\controllers\Controller;
use app\modules\infosystems\service\InfosystemModelService;

class InfosystemController extends Controller
{
    public function actionView($id)
    {
        $modelService = Yii::createObject([
            'class' => InfosystemModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);

        if (!$modelService->view()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        $viewFile = $modelService->getData('model')
            ->template;

        return $this->render($viewFile, ['data' => $modelService->getData()]);
    }
}