<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use app\modules\informationsystem\components\BackendController;
use app\modules\informationsystem\models\Group;
use app\modules\informationsystem\models\Item;
use app\modules\informationsystem\models\Tag;

class UpdateController extends BackendController
{
	public $defaultAction = 'system';
	
	public function actions()
	{
		return [
			'system' => [
				'class' => 'app\core\actions\Update',
				'model' => '\app\modules\informationsystem\models\Informationsystem',
				'view' => 'system',
				'redirect' => ['manager/system'],
			],
		];
	}

    public function actionGroup($id)
    {
        $model = Group::findOne($id);

        if ($model->load(Yii::$app->request->post()) and $model->save()) {

            return $this->redirect([
                'manager/group',
                'parent_id' => $model->parent_id,
                'informationsystem_id' => $model->informationsystem_id,
            ]);
        }

        return $this->render('group', [
            'model' => $model,
            'breadcrumbs' => Group::buildBreadcrumbs($model->id, $model->informationsystem_id),
        ]);
    }

    public function actionItem($id)
	{
		$model = Item::findOne($id);
		
		if ($model->load(Yii::$app->request->post()) and $model->save()) {
				
			return $this->redirect([
				'manager/group',
				'informationsystem_id' => $model->informationsystem_id,
				'parent_id' => $model->group_id,
			]);
		}
		
		return $this->render('item', [
				'model' => $model,
				'breadcrumbs' => Group::buildBreadcrumbs($model->group_id, $model->informationsystem_id),
			]);
	}	
	
	public function actionTag($id)
	{
		$model = Tag::findOne($id);
		
		if ($model->load(Yii::$app->request->post()) and $model->save()) {
			
			return $this->redirect([
							'manager/tag',
							'informationsystem_id' => $model->informationsystem_id,
						]);				
		}
		
		return $this->render('tag', [
						'model' => $model,
						'informationsytem_id' => $model->informationsystem_id, 	
						'breadcrumbs' => Group::buildBreadcrumbs(null, $model->informationsystem_id),
					]);
	}
}
