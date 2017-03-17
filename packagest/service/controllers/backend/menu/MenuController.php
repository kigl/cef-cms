<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.02.2017
 * Time: 19:50
 */

namespace kigl\cef\module\service\controllers\backend\menu;


use Yii;
use yii\data\ActiveDataProvider;
use kigl\cef\module\service\components\BackendController;
use kigl\cef\core\actions\Create;
use kigl\cef\core\actions\Update;
use kigl\cef\module\service\service\MenuModelService;
use kigl\cef\module\service\models\menu\Menu;

class MenuController extends BackendController
{
    public function actions()
    {
        return [
            'create' => [
                'class' => Create::className(),
                'modelClass' => Menu::className(),
            ],
            'update' => [
                'class' => Update::className(),
                'modelClass' => Menu::className(),
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

    public function actionDelete($id)
    {
        $modelService = Yii::createObject(MenuModelService::class);
        $modelService->actionDelete($id);

        if ($modelService->hasExecutedAction($modelService::EXECUTED_ACTION_DELETE)) {
            return $this->redirect(['manager']);
        }
    }
}