<?php
/**
 * Class FormFieldController
 * @package app\modules\service\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\forms\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\backend\actions\EditAttribute;
use app\modules\forms\service\backend\FieldModelService;
use app\modules\forms\models\backend\Field;

class BackendFieldController extends Controller
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

    public function actionCreate($form_id, $group_id = null)
    {
        $modelService = Yii::createObject(FieldModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->post(),
        ]);

        if ($modelService->actionCreate()) {
            return $this->redirect([
                'backend-group/manager',
                'form_id' => $modelService->getData('model')->form_id,
                'id' => $modelService->getData('model')->group_id
                ]);
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

        if ($modelService->actionUpdate()) {
            return $this->redirect([
                'backend-group/manager',
                'form_id' => $modelService->getData('model')->form_id,
                'id' => $modelService->getData('model')->group_id
            ]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Field::findOne($id);

        if ($model->delete()) {
            return $this->redirect([
                'backend-group/manager',
                'form_id' => $model->form_id,
                'id' => $model->group_id
            ]);
        }
    }
}