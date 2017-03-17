<?php
/**
 * Class TagController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\tag\controllers\backend;


use Yii;
use kigl\cef\module\tag\components\BackendController;
use kigl\cef\module\tag\models\Tag;
use kigl\cef\module\tag\service\backend\TagModelService;

class TagController extends BackendController
{
    public function actionManager()
    {
        $modelService = Yii::createObject([
            'class' => TagModelService::class,
        ]);
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate()
    {
        $modelService = Yii::createObject([
            'class' => TagModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);
        $modelService->actionCreate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'manager',
            ]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject([
            'class' => TagModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);
        $modelService->actionUpdate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {

            return $this->redirect([
                'manager',
            ]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Tag::findOne($id);

        if ($model->delete()) {
            //ItemTag::deleteAll("tag_id = {$model->id}");

            return $this->redirect(['manager']);
        }

        return false;
    }
}