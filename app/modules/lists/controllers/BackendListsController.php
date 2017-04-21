<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 12.03.2017
 * Time: 19:25
 */

namespace app\modules\lists\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\lists\Module;
use app\modules\backend\controllers\Controller;
use app\modules\lists\models\backend\Lists;

class BackendListsController extends Controller
{
    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Lists::find(),
        ]);

        return $this->render('manager', [
            'data' => [
                'dataProvider' => $dataProvider,
                'breadcrumbs' => $this->getItemsBreadcrumbs(),
            ]
        ]);
    }

    public function actionCreate()
    {
        $model = new Lists();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manager']);
        }

        return $this->render('create', [
            'data' => [
                'model' => $model,
                'breadcrumbs' => $this->getItemsBreadcrumbs(),
            ]
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Lists::find()
            ->where(['id' => $id])
            ->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manager']);
        }

        return $this->render('create', [
            'data' => [
                'model' => $model,
                'breadcrumbs' => $this->getItemsBreadcrumbs($model->name),
            ]
        ]);
    }

    public function actionDelete($id)
    {
        $model = Lists::findOne($id);

        if ($model->delete()) {
            return $this->redirect(['manager']);
        }
    }

    protected function getItemsBreadcrumbs($currentItemName = null)
    {
        $breadcrumbs = [];
        $breadcrumbs[] = ['label' => Module::t('Lists'), 'url' => ['backend-lists/manager']];

        if ($currentItemName) {
            $breadcrumbs[] = ['label' => $currentItemName];
        }

        return $breadcrumbs;
    }
}