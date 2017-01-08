<?php
/**
 * Class GroupController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use Yii;
use app\core\actions\View;
use app\modules\shop\components\FrontendController;
use app\modules\shop\service\frontend\GroupModelService;
use app\modules\shop\service\frontend\GroupViewService;
use app\modules\shop\models\Group;

class GroupController extends FrontendController
{
    public function actionView($id, $alias = '')
    {
        $modelService = new GroupModelService();
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->view();

        if ($modelService->hasError($modelService::ERROR_NOT_MODEL)) {
            throw new HttpException(404);
        }
        
        $viewService = (new GroupViewService())->setData($modelService->getData());

        return $this->render('view', [
            'data' => $viewService,
        ]);
    }
}