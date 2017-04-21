<?php
/**
 * Class ItemGroupController
 * @package app\modules\infosystem\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers;


use Yii;
use app\modules\infosystem\components\FrontendController;
use app\modules\infosystem\service\frontend\ItemModelService;
use yii\base\Controller;

class ItemController extends Controller
{
    public function actionView($id, $alias, $infosystem_id)
    {
        $modelService = Yii::createObject([
            'class' => ItemModelService::class,
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
            ],
        ]);
        $modelService->actionView();

        // Проверяем инфосистему и алиас
        if ($modelService->hasError($modelService::ERROR_NOT_MODEL_ALIAS)) {
            return $this->redirect([
                'view',
                'id' => $modelService->getData('model')->id,
                'alias' => $modelService->getData('model')->alias,
                'infosystem_id' => $modelService->getData('model')->infosystem_id
            ], 302);
        }

        $viewFile = $modelService->getData('model')
            ->infosystem
            ->template_item;

        return $this->render($viewFile, ['data' => $modelService->getData()]);
    }
}