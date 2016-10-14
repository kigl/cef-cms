<?php

namespace app\modules\informationsystem\controllers\backend;


use Yii;
use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\models\Group;
use app\modules\informationsystem\models\Item;
use app\modules\informationsystem\models\Tag;
use app\modules\informationsystem\models\TagRelations;

class DeleteController extends \app\modules\admin\components\controllers\BackendController
{

	public function actionSystem($id)
	{	
		if ($modelSystem = System::findOne($id)) {
		    $modelGroup = Group::findAll(['informationsystem_id' => $modelSystem->id]);
			$modelItem = Item::findAll(['informationsystem_id' => $modelSystem->id]);

			if ($modelGroup) {
                foreach ($modelGroup as $group) {
                    $group->delete();
                }
            }

            if ($modelItem) {
                foreach ($modelItem as $item) {
                    $item->delete();
                }
            }

			if ($modelSystem->delete()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Deleted element'));

                return $this->redirect(['manager/system']);
            }
		}

		return false;
	}

    public function actionGroup($id)
    {
        $model = Group::findOne($id);

        if ($model) {
            $modelGroups = Group::findAll(['parent_id' => $model->id]);
            $modelItems = Item::findAll(['group_id' => $model->id]);

            if ($modelGroups) {
                foreach ($modelGroups as $group) {
                    $group->delete();
                }
            }

            if ($modelItems) {
                foreach ($modelItems as $item) {
                    $item->delete();
                }
            }

            if ($model->delete()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Deleted element'));

                return $this->redirect([
                    'manager/group',
                    'parent_id' => $model->parent_id,
                    'informationsystem_id' => $model->informationsystem_id,
                ]);
            }
        }

        return false;
    }
	
	public function actionItem($id)
	{
		$model = Item::findOne($id);
		
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Deleted element'));

            return $this->redirect([
                'manager/group',
                'parent_id' => $model->group_id,
                'informationsystem_id' => $model->informationsystem_id,
            ]);
        }

        return false;
	}

	public function actionTag($id)
    {
        $model = Tag::findOne($id);

        if ($model->delete()) {
            TagRelations::deleteAll("tag_id = {$model->id}");

            return $this->redirect(['manager/tag', 'informationsystem_id' => $model->informationsystem_id]);
        }

        return false;
    }
}