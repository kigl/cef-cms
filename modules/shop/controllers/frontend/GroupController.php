<?php
/**
 * Class GroupController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use Yii;
use app\modules\shop\components\FrontendController;
use app\modules\shop\models\frontend\GroupService;
use app\modules\shop\models\Group;

class GroupController extends FrontendController
{
    public $layout = '@app/modules/shop/views/frontend/layouts/column_2';

    public function actionView($id)
    {
        $modelService = new GroupService();
        $modelService->setRequestData(['get' => Yii::$app->request->getQueryParams()]);
        $modelService->view();

        return $this->render('view', $modelService->getData());
    }

    public function actionList()
    {
        $model = Group::find()->all();

        return $this->render('list', ['model' => $model]);
    }
}