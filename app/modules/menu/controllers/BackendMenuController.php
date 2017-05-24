<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.02.2017
 * Time: 19:50
 */

namespace app\modules\menu\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\backend\controllers\Controller;
use app\modules\backend\actions\Create;
use app\modules\backend\actions\Update;
use app\modules\menu\service\backend\MenuModelService;
use app\modules\menu\models\backend\Menu;

class BackendMenuController extends Controller
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
            'query' => Menu::find()
                ->where(['site_id' => Yii::$app->site->getId()]),
        ]);

        return $this->render('manager', ['dataProvider' => $dataProvider]);
    }

    public function actionDelete($id)
    {
        $modelService = Yii::createObject(MenuModelService::class);

        if ($modelService->delete($id)) {
            return $this->redirect(['manager']);
        }
    }
}