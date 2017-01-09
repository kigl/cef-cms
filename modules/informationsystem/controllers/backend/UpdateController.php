<?php

namespace app\modules\informationsystem\controllers\backend;

use Yii;
use app\modules\informationsystem\service\backend\GroupModelService;
use app\modules\informationsystem\service\backend\GroupViewService;
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
				'views' => 'system',
				'redirect' => ['manager/system'],
			],
		];
	}

    public function actionGroup($id)
    {
        $modelService = new GroupModelService();
        $modelService->setData([
            'post' => Yii::$app->request->post(),
            'get' => Yii::$app->request->getQueryParams(),
        ]);
        $modelService->actionUpdate();

        $viewService = (new GroupViewService())->setData($modelService->getData());

        if ($modelService->hasAction($modelService::ACTION_SAVE)) {

            return $this->redirect([
                'manager/group',
                'parent_id' => $modelService->getData('parentId'),
                'informationsystem_id' => $modelService->getData('informationsystemId'),
            ]);
        }

        return $this->render('group', ['data' => $viewService]);
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
