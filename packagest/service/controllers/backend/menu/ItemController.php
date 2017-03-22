<?php
/**
 * Class MenuItemController
 * @package app\modules\backend\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\service\controllers\backend\menu;


use Yii;
use kigl\cef\module\service\components\BackendController;
use kigl\cef\module\service\models\menu\Item;
use kigl\cef\module\service\service\menu\ItemModelService;
use kigl\cef\core\actions\EditAttribute;

class ItemController extends BackendController
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
        $modelService->actionManager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate($menu_id, $parent_id = null)
    {
        $modelService = Yii::createObject(ItemModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->post(),
        ]);
        $modelService->actionCreate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
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
        $modelService->actionUpdate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
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
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {
            return $this->redirect([
                'manager',
                'menu_id' => $modelService->getData('model')->menu_id,
                'id' => $modelService->getData('parent_id'),
            ]);
        }
    }
}