<?php
/**
 * Class GroupController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use app\modules\shop\components\FrontendController;
use app\modules\shop\service\frontend\GroupModelService;
use app\modules\shop\service\frontend\GroupViewService;

class GroupController extends Controller
{
    public function actionView($id, $alias = '')
    {
        $modelService = new GroupModelService();
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->actionView();

        if ($modelService->hasError($modelService::ERROR_NOT_MODEL)) {
            throw new HttpException(404);
        }

        if ($modelService->hasError($modelService::ERROR_NOT_MODEL_ALIAS)) {
            $this->redirect([
                '/shop/group/view',
                'id' => $id,
                'alias' => $modelService->getData('model')->alias], 301);
        }

        return $this->render('view', [
            'data' => $modelService->getData(),
        ]);
    }
}