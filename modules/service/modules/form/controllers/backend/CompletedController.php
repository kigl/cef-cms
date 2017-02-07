<?php
/**
 * Class FormCopletedController
 * @package app\modules\service\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\modules\form\controllers\backend;


use Yii;
use app\modules\service\components\BackendController;
use app\modules\service\modules\form\service\CompletedModelService;

class CompletedController extends BackendController
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
}