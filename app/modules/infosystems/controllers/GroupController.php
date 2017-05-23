<?php
/**
 * Class ManagerController
 * @package app\modules\infosystem\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\controllers;


use Yii;
use app\modules\infosystems\service\GroupModelService;
use app\controllers\Controller;

class GroupController extends Controller
{
    public function actionView($id, $alias, $infosystem_id)
    {
        $modelService = Yii::createObject([
            'class' => GroupModelService::class,
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);
        $modelService->actionView();

        if ($modelService->hasError($modelService::ERROR_NOT_MODEL_ALIAS)) {
           return $this->redirect([
                'view',
                'id' => $modelService->getData('model')->id,
                'alias' => $modelService->getData('model')->alias,
                'infosystem_id' => $modelService->getData('model')->infosystem->code
                ], 302);
        }

        $viewFile = $modelService->getData('model')
            ->infosystem
            ->template_group;

        return $this->render($viewFile, ['data' => $modelService->getData()]);
    }
}