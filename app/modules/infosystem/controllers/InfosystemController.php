<?php
/**
 * Class InfosystemController
 * @package app\modules\infosystem\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers;


use app\modules\infosystem\service\InfosystemModelService;
use Yii;
use yii\web\Controller;

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

        $modelService->view();

        $viewFile = $modelService->getData('model')
            ->template;

        return $this->render($viewFile, ['data' => $modelService->getData()]);
    }
}