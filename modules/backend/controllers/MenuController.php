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
use app\modules\backend\service\MenuModelService;
use app\core\actions\Create;
use app\core\actions\Update;
use app\modules\backend\components\Controller;
use app\modules\backend\models\Menu;

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