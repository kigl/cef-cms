<?php
/**
 * Class BackendGroupController
 * @package app\modules\form\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\form\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\form\models\backend\service\GroupModelService;
use app\modules\backend\actions\EditAttribute;
use app\modules\form\models\backend\Group;

class BackendGroupController extends Controller
{
    public function actions()
    {
        return [
            'edit-sorting' => [
                'class' => EditAttribute::class,
                'modelClass' => Group::class,
                'attribute' => 'sorting',
            ],
        ];
    }

    public function actionManager($form_id, $id = null)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->post(),
        ]);
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate($form_id, $parent_id = null)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->post(),
        ]);

        if ($modelService->actionCreate()) {
            return $this->redirect([
                'manager',
                'form_id' => $modelService->getData('model')->form_id,
                'id' => $modelService->getData('model')->id,
                ]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject(GroupModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->post(),
        ]);

        if ($modelService->actionUpdate()) {
            return $this->redirect([
                'manager',
                'form_id' => $modelService->getData('model')->form_id,
                'id' => $modelService->getData('model')->id,
            ]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Group::findOne($id);

        if ($model->delete()) {
            return $this->redirect([
                'manager',
                'form_id' => $model->form_id,
                'id' => $model->parent_id,
                ]);
        }
    }
}