<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 12.03.2017
 * Time: 19:35
 */

namespace app\modules\lists\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\backend\controllers\Controller;
use app\modules\lists\Module;
use app\modules\lists\models\backend\Lists;
use app\modules\lists\models\backend\Item;

class BackendItemController extends Controller
{
    public function actionManager($list_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find()
                ->where(['list_id' => $list_id])
        ]);

        $modelLists = Lists::findOne($list_id);

        return $this->render('manager', [
            'data' => [
                'dataProvider' => $dataProvider,
                'listId' => $list_id,
                'breadcrumbs' => $this->getItemsBreadcrumbs($modelLists),
            ]
        ]);
    }

    public function actionCreate($list_id)
    {
        $model = new Item([
            'list_id' => (integer)$list_id
        ]);

        $modelLists = Lists::findOne($list_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manager', 'list_id' => $modelLists->id]);
        }

        return $this->render('create', [
            'data' => [
                'model' => $model,
                'breadcrumbs' => $this->getItemsBreadcrumbs($modelLists),
            ]
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Item::find()
            ->where(['id' => $id])
            ->with('lists')
            ->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manager', 'list_id' => $model->lists->id]);
        }

        return $this->render('create', [
            'data' => [
                'model' => $model,
                'breadcrumbs' => $this->getItemsBreadcrumbs($model->lists, $model->value),
            ]
        ]);
    }

    public function actionDelete($id)
    {
        $model = Item::findOne($id);

        if ($model->delete()) {
            return $this->redirect(['manager', 'list_id' => $model->list_id]);
        }
    }

    protected function getItemsBreadcrumbs($lists, $currentItemName = null)
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['label' => Module::t('Lists'), 'url' => ['backend-lists/manager']];
        $breadcrumbs[] = ['label' => $lists->name, 'url' => ['backend-item/manager', 'list_id' => $lists->id]];

        if ($currentItemName) {
            $breadcrumbs[] = ['label' => $currentItemName];
        }

        return $breadcrumbs;
    }
}