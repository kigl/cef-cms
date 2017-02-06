<?php
/**
 * Class MenuItemController
 * @package app\modules\backend\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\controllers\backend;


use Yii;
use app\modules\service\models\MenuItem;
use app\modules\backend\components\Controller;
use app\modules\service\service\MenuItemModelService;
use app\core\actions\EditAttribute;

class MenuItemController extends Controller
{
    public function actions()
    {
        return [
            'edit-position' => [
                'class' => EditAttribute::class,
                'modelClass' => MenuItem::class,
                'attribute' => 'position',
                'queryParams' => Yii::$app->request->getQueryParams(),
                'postData' => Yii::$app->request->post(),
            ]
        ];
    }

    public function actionManager($menu_id, $parent_id = null)
    {
        $modelService = Yii::createObject(MenuItemModelService::class)
            ->setData([
                    'get' => Yii::$app->request->getQueryParams()
                ]
            );
        $modelService->actionManager();

        return $this->render('/menu/item/manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate($menu_id, $parent_id = null)
    {
        $modelService = Yii::createObject(MenuItemModelService::class);
        $modelService->setData([
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->post(),
        ]);
        $modelService->actionCreate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect([
                'manager',
                'menu_id' => $modelService->getData('model')->menu_id,
                'parent_id' => $modelService->getData('model')->parent_id,
            ]);
        }

        return $this->render('/menu/item/create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        $modelService = Yii::createObject(MenuItemModelService::class)
            ->setData([
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ]);
        $modelService->actionUpdate();

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_SAVE)) {
            return $this->redirect([
                'manager',
                'menu_id' => $modelService->getData('model')->menu_id,
                'parent_id' => $modelService->getData('model')->parent_id,
            ]);
        }

        return $this->render('/menu/item/update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $modelService = YiI::createObject(MenuItemModelService::class);
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {
            return $this->redirect([
                'manager',
                'menu_id' => $modelService->getData('model')->menu_id,
                'parent_id' => $modelService->getData('parent_id'),
            ]);
        }
    }
}