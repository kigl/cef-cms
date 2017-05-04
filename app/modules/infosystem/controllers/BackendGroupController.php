<?php
/**
 * Class GroupController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers;


use Yii;
use app\modules\backend\actions\EditAttribute;
use app\modules\backend\controllers\Controller;
use app\modules\infosystem\service\backend\GroupModelService;
use app\modules\infosystem\models\backend\Group;

class BackendGroupController extends Controller
{
    public function actions()
    {
        return [
            'edit-sorting' => [
                'class' => EditAttribute::class,
                'modelClass' => Group::class,
            ],
        ];
    }

    public function actionManager($id = null, $infosystem_id)
    {
        $modelService = Yii::createObject([
            'class' => GroupModelService::class,
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);

        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate($infosystem_id, $parent_id = null)
    {
        $modelService = Yii::createObject([
            'class' => GroupModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);

        if ($modelService->actionCreate()) {
            return $this->redirect([
                'manager',
                'id' => $modelService->getData('model')->parent_id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject([
            'class' => GroupModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);

        if ($modelService->actionUpdate()) {

            return $this->redirect([
                'manager',
                'id' => $modelService->getData('model')->parent_id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = Yii::createObject(GroupModelService::class);

        if ($modelService->actionDelete($id)) {

            return $this->redirect([
                'manager',
                'id' => $modelService->getData('model')->parent_id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return false;
    }

    public function actionSelectionDelete()
    {
        if ($keys = Yii::$app->request->post('selection')) {

            $modelService = Yii::createObject(GroupModelService::className());

            foreach ($keys as $key) {
                $modelService->actionDelete($key);
            }

            return true;
        }

        return false;
    }
}