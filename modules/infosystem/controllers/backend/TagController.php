<?php
/**
 * Class TagController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers\backend;


use Yii;
use app\modules\infosystem\components\BackendController;
use app\modules\infosystem\models\Tag;
use app\modules\infosystem\service\backend\TagModelService;

class TagController extends BackendController
{
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
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return $this->render('tag', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Tag::findOne($id);

        if ($model->delete()) {
            //ElementTag::deleteAll("tag_id = {$model->id}");

            return $this->redirect(['manager', 'infosystem_id' => $model->infosystem_id]);
        }

        return false;
    }
}