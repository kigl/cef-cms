<?php
/**
 * Class FormCopletedController
 * @package app\modules\service\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\service\controllers\backend\form;


use Yii;
use kigl\cef\module\service\components\BackendController;
use akigl\cef\module\service\models\form\Completed;;
use kigl\cef\module\service\service\form\CompletedModelService;

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

    public function actionDelete($id)
    {
        $model = Completed::findOne($id);

        if ($model->delete()) {
            return $this->redirect(['manager', 'form_id' => $model->form_id]);
        }
    }
}