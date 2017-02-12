<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.02.2017
 * Time: 19:50
 */

namespace app\modules\service\modules\menu\controllers\backend;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\service\modules\menu\service\MenuModelService;
use app\core\actions\Create;
use app\core\actions\Update;
use app\modules\service\components\BackendController;
use app\modules\service\modules\menu\models\Menu;

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