<?php
/**
 * Class TagController
 * @package app\modules\informationsystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\controllers\backend;


use Yii;
use app\modules\informationsystem\components\BackendController;
use app\modules\informationsystem\models\Tag;
use app\modules\informationsystem\service\backend\TagModelService;

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
                'informationsystem_id' => $modelService->getData('model')->informationsystemId,
            ]);
        }

        return $this->render('tag', ['data' => $modelService->getData()]);
    }

    public function actioDelete($id)
    {
        $model = Tag::findOne($id);

        if ($model->delete()) {
            //TagRelations::deleteAll("tag_id = {$model->id}");

            return $this->redirect(['manager', 'informationsystem_id' => $model->informationsystem_id]);
        }

        return false;
    }
}