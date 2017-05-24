<?php
/**
 * Class MenuItemController
 * @package app\modules\backend\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\menu\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\menu\models\backend\Item;
use app\modules\menu\service\backend\ItemModelService;
use app\modules\backend\actions\EditAttribute;

class BackendItemController extends Controller
{
    public function actions()
    {
        return [
            'edit-sorting' => [
                'class' => EditAttribute::class,
                'modelClass' => Item::class,
                'attribute' => 'sorting',
            ],
        ];
    }

    public function actionManager($menu_id, $id = null)
    {
        $modelService = Yii::createObject(ItemModelService::class)
            ->setData([
                    'get' => Yii::$app->request->getQueryParams()
                ]
            );
        $modelService->manager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate($menu_id, $parent_id = null)
    {
        $modelService = Yii::createObject(ItemModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->post(),
        ]);

        if ($modelService->create()) {
            return $this->redirect([
                'manager',
                'menu_id' => $modelService->getData('model')->menu_id,
                'id' => $modelService->getData('model')->parent_id,
            ]);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject(ItemModelService::class)
            ->setData([
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ]);

        if ($modelService->update()) {
            return $this->redirect([
                'manager',
                'menu_id' => $modelService->getData('model')->menu_id,
                'id' => $modelService->getData('model')->parent_id,
            ]);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = YiI::createObject(ItemModelService::class);

        if ($modelService->delete($id)) {
            return $this->redirect([
                'manager',
                'menu_id' => $modelService->getData('model')->menu_id,
                'id' => $modelService->getData('parent_id'),
            ]);
        }
    }
}