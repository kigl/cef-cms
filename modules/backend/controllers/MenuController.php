<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.02.2017
 * Time: 19:50
 */

namespace app\modules\backend\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use app\core\actions\Create;
use app\core\actions\Update;
use app\modules\backend\service\MenuItemModelService;
use app\modules\backend\components\Controller;
use app\modules\backend\models\Menu;
use app\modules\backend\models\MenuItem;

class MenuController extends Controller
{
    public function actions()
    {
        return [
            'create' => [
                'class' => Create::className(),
                'model' => Menu::className(),
            ],
            'update' => [
                'class' => Update::className(),
                'model' => Menu::className(),
            ],
            'create-item' => [
                'class' => Create::className(),
                'model' => MenuItem::className(),
                'view' => 'item/create',
            ],
            'update-item' => [
                'class' => Update::className(),
                'model' => MenuItem::className(),
                'view' => 'item/update',
            ],
        ];
    }


    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Menu::find(),
        ]);

        return $this->render('manager', ['dataProvider' => $dataProvider]);
    }

    public function actionManagerItem($menu_id, $parent_id = null)
    {
        $modelService = Yii::createObject(MenuItemModelService::class);
        $modelService->actionManager(Yii::$app->request->getQueryParams());

        return $this->render('item/manager', ['data' => $modelService->getData()]);
    }
}