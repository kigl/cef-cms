<?php
/**
 * Class FormFieldController
 * @package app\modules\service\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\controllers\backend\form;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\service\components\BackendController;
use app\core\actions\EditAttribute;
use app\modules\service\service\form\FieldModelService;
use app\modules\service\models\form\Field;

class FieldController extends BackendController
{
    public function actions()
    {
        return [
            'edit-sorting' => [
                'class' => EditAttribute::class,
                'modelClass' => Field::class,
                'attribute' => 'sorting',
            ],
        ];
    }

    public function actionManager($form_id)
    {
        $modelService = Yii::createObject(FieldModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->post(),
        ]);
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate($form_id)
    {
        $modelService = Yii::createObject(FieldModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->post(),
        ]);
        $modelService->actionCreate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['manager', 'form_id' => $modelService->getData('model')->form_id]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject(FieldModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->post(),
        ]);
        $modelService->actionUpdate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect(['manager', 'form_id' => $modelService->getData('model')->form_id]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Field::findOne($id);

        if ($model->delete()) {
            return $this->redirect(['manager', 'form_id' => $model->form_id]);
        }
    }
}