<?php

namespace app\modules\shop\controllers\backend;

use Yii;
use app\modules\shop\models\GroupSearch;
use app\modules\shop\models\Group;

class GroupController extends \app\modules\admin\components\controllers\BackendController
{

    public function actionManager($parent_id = 0)
    {
        $dataProviderSearch = new GroupSearch();
        $dataProviderGroup = $dataProviderSearch->search($parent_id, Yii::$app->request->getQueryParams());

        return $this->render('manager', [
            'parent_id' => $parent_id,
            'dataProviderGroup' => $dataProviderGroup,
        ]);
    }

    public function actionCreate($parent_id)
    {
        $model = new Group;

        if ($model->load(Yii::$app->request->post())) {
            $model->parent_id = $parent_id;

            if ($model->save()) return $this->redirect(['manager', 'parent_id' => $parent_id]);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Group::findOne($id);

        if ($model->load(Yii::$app->request->post()) and $model->save()) {

            return $this->redirect(['manager', 'parent_id' => $model->parent_id]);
        }

        return $this->render('update', ['model' => $model]);
    }
}