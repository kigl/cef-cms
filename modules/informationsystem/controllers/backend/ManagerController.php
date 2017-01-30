<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\informationsystem\components\BackendController;
use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\models\Group;
use app\modules\informationsystem\models\Item;
use app\modules\informationsystem\models\ItemSearch;
use app\modules\informationsystem\models\Tag;
use app\modules\informationsystem\models\TagSearch;

class ManagerController extends BackendController
{
    public $defaultAction = 'system';

    public function actionSystem()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => System::find(),
        ]);

        return $this->render('system', ['dataProvider' => $dataProvider]);
    }

    public function actionGroup($id = 0, $informationsystem_id)
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search($informationsystem_id, $id, Yii::$app->request->queryParams);

        $dataProviderGroup = new ActiveDataProvider([
            'query' => Group::find()
                ->parentId($id)
                ->informationsystemId($informationsystem_id),
        ]);

        return $this->render('group', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderGroup' => $dataProviderGroup,
            'informationsystem_id' => $informationsystem_id,
            'id' => $id,
        ]);
    }

    public function actionTag($informationsystem_id)
    {
        $modelTag = new Tag;

        if ($modelTag->load(Yii::$app->request->post()) and $modelTag->save()) {
            $modelTag = new Tag;
        }

        $model = new TagSearch;
        $system = System::getSystem($informationsystem_id);

        $dataProvider = $model->search($informationsystem_id, Yii::$app->request->getQueryParams());

        return $this->render('tag', [
            'dataProvider' => $dataProvider,
            'searchModel' => $model,
            'system' => $system,
            'informationsystem_id' => $informationsystem_id,
            'breadcrumbs' => Group::buildBreadcrumbs(null, $informationsystem_id),
            'modelTag' => $modelTag,
        ]);
    }
}
