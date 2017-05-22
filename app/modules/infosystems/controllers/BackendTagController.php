<?php
/**
 * Class TagController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\infosystems\service\backend\TagModelService;
use app\modules\infosystems\models\backend\Tag;

class BackendTagController extends Controller
{
    public function actionManager()
    {
        $modelService = Yii::createObject([
            'class' => TagModelService::class,
        ]);
        $modelService->manager();

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
        $modelService->create();

        if ($modelService->create()) {

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


        if ($modelService->update()) {

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

    public function actionSelectionDelete()
    {
        if ($keys = Yii::$app->request->post('selection')) {
            Tag::deleteAll(['in', 'id', $keys]);

            return true;
        }

        return false;
    }
}