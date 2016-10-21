<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use app\modules\informationsystem\models\Group;
use app\modules\informationsystem\models\Item;
use app\modules\informationsystem\models\Tag;

class CreateController extends \app\modules\admin\components\controllers\BackendController
{
    public $defaultAction = 'system';

    public function actions()
    {
        return [
            'system' => [
                'class' => 'app\components\actions\Create',
                'model' => '\app\modules\informationsystem\models\Informationsystem',
                'view' => 'system',
                'redirect' => ['manager/system'],
            ],
        ];
    }

    public function actionGroup($informationsystem_id, $parent_id = 0)
    {
        $model = new Group;

        if ($model->load(Yii::$app->request->post()) and $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Created element'));

            return $this->redirect([
                'manager/group',
                'parent_id' => $parent_id,
                'informationsystem_id' => $informationsystem_id,
            ]);
        }

        return $this->render('group', [
            'model' => $model,
            'breadcrumbs' => Group::buildBreadcrumbs($parent_id, $informationsystem_id),
            'informationsystem_id' => $informationsystem_id,
            'parent_id' => $parent_id,
        ]);
    }

    public function actionItem($group_id = 0, $informationsystem_id)
    {
        $model = new Item;

        if ($model->load(Yii::$app->request->post()) and $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Created element'));

            return $this->redirect([
                'manager/group',
                'parent_id' => $group_id,
                'informationsystem_id' => $informationsystem_id,
            ]);
        }

        return $this->render('item', [
            'model' => $model,
            'breadcrumbs' => Group::buildBreadcrumbs($group_id, $informationsystem_id),
            'informationsystem_id' => $informationsystem_id,
            'group_id' => $group_id,
        ]);
    }

    public function actionTag($informationsystem_id)
    {
        $model = new Tag;

        if ($model->load(Yii::$app->request->post()) and $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Created element'));

            return $this->redirect([
                'manager/tag',
                'informationsystem_id' => $informationsystem_id,
            ]);
        }

        return $this->render('tag', [
            'model' => $model,
            'informationsytem_id' => $informationsystem_id,
            'breadcrumbs' => Group::buildBreadcrumbs(null, $informationsystem_id),
        ]);
    }
}
