<?php
/**
 * Class ItemController
 * @package app\modules\infosystem\controllers\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers;


use Yii;
use vova07\imperavi\actions\GetAction;
use app\modules\backend\controllers\Controller;
use app\modules\infosystem\models\backend\service\ItemModelService;
use app\modules\backend\actions\EditAttribute;
use app\modules\infosystem\models\backend\Item;

class BackendItemController extends Controller
{
    public function actions()
    {
        return [
            'edit-sorting' => [
                'class' => EditAttribute::class,
                'modelClass' => Item::class,
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => Yii::getAlias('@web/public/uploads/infosystem/content'),
                'path' => Yii::getAlias('@webroot/public/uploads/infosystem/content'),
                'type' => GetAction::TYPE_IMAGES,
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => Yii::getAlias('@web/public/uploads/infosystem/content'),
                'path' => Yii::getAlias('@webroot/public/uploads/infosystem/content'),
            ],
        ];
    }

    public function actionCreate($group_id = null, $infosystem_id)
    {
        $modelService = Yii::createObject([
            'class' => ItemModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);

        if ($modelService->actionCreate()) {
            return $this->redirect([
                'backend-group/manager',
                'id' => $modelService->getData('model')->group_id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject([
            'class' => ItemModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
                'get' => Yii::$app->request->getQueryParams(),
            ]
        ]);

        if ($modelService->actionUpdate()) {

            return $this->redirect([
                'backend-group/manager',
                'id' => $modelService->getData('model')->group_id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = Yii::createObject(ItemModelService::class);

        if ($modelService->actionDelete($id)) {

            return $this->redirect([
                'backend-group/manager',
                'id' => $modelService->getData('model')->group_id,
                'infosystem_id' => $modelService->getData('model')->infosystem_id,
            ]);
        }

        return false;
    }

    public function actionSelectionDelete()
    {
        if ($keys = Yii::$app->request->post('selection')) {

            $modelService = Yii::createObject(ItemModelService::className());

            foreach ($keys as $key) {
                $modelService->actionDelete($key);
            }

            return true;
        }

        return false;
    }
}