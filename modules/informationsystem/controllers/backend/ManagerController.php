<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\informationsystem\components\Controller;
use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\models\Group;
use app\modules\informationsystem\models\Item;
use app\modules\informationsystem\models\ItemSearch;
use app\modules\informationsystem\models\Tag;
use app\modules\informationsystem\models\TagSearch;

class ManagerController extends Controller
{
    public function actions()
    {
        return [
            'view' => [
                'class' => 'app\core\components\actions\View',
                'model' => Item::className(),
                'view' => 'view',
            ],
        ];
    }

    public $defaultAction = 'system';

    public function actionSystem()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => System::find(),
            'pagination' => [
                'pageSize' => $this->module->itemsOnPage,
            ],
        ]);

        return $this->render('system', ['dataProvider' => $dataProvider]);
    }

    public function actionGroup($parent_id = 0, $informationsystem_id)
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search($informationsystem_id, $parent_id, Yii::$app->request->queryParams);

        $dataProviderGroup = new ActiveDataProvider([
            'query' => Group::find()
                ->where('parent_id = :parent_id', [':parent_id' => $parent_id])
                ->andWhere('informationsystem_id = :system_id', [':system_id' => $informationsystem_id]),
        ]);

        return $this->render('group', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderGroup' => $dataProviderGroup,
            'informationsystem_id' => $informationsystem_id,
            'parent_id' => $parent_id,
            'breadcrumbs' => Group::buildBreadcrumbs($parent_id, $informationsystem_id),
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
