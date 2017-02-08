<?php
/**
 * Class FormCopletedController
 * @package app\modules\service\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\modules\form\controllers\backend;


use app\modules\service\modules\form\models\Completed;
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

    public function actionView($id)
    {
        $model = Completed::find()
            ->where(['id' => $id])
            ->with('fieldsValue.field')
            ->one();

        return $this->render('view', ['data' => ['model' => $model]]);
    }
}