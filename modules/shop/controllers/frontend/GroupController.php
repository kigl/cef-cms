<?php
/**
 * Class GroupController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use Yii;
use app\modules\shop\components\FrontendController;
use app\modules\shop\service\frontend\GroupModelService;
use app\modules\shop\service\frontend\GroupViewService;
use app\modules\shop\models\Group;

class GroupController extends FrontendController
{
    //public $layout = '@app/modules/shop/views/frontend/layouts/column_2';

    public function actionView($id)
    {
        $modelService = new GroupModelService();
        $modelService->setRequestData(['get' => Yii::$app->request->getQueryParams()]);
        $modelService->view();

        $viewService = (new GroupViewService())->setData($modelService->getData());

        return $this->render('view', ['data' => $viewService]);
    }

    public function actionList()
    {
        $model = Group::find()->all();

        return $this->render('list', ['model' => $model]);
    }
}