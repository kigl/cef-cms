<?php

namespace app\modules\forum\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\forum\models\Topic;
use app\modules\forum\models\Post;

class TopicController extends \app\modules\forum\controllers\FrontendControllerAbstract
{
		
	public function actionManager($parentId)
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Topic::find()
									->with(['author'])
									->where('parent_id = :parent_id', [':parent_id' => $parentId])
									->orderBy('id DESC'),
			'sort' => false,
		]);
		
		return $this->render('manager', [
			'dataProvider' => $dataProvider,
			'parentId' => $parentId,
			'breadcrumbs' => static::buildBreadcrumbs($parentId),
		]);
	}
	
	public function actionCreate($parentId)
	{
		$modelTopic = new Topic;
		$modelPost = new Post;
		
		if ($modelTopic->load(Yii::$app->request->post()) and $modelPost->load(Yii::$app->request->post())) {
			if ($modelTopic->save()) {
				$modelPost->topic_id = $modelTopic->id;
				if ($modelPost->save())	{
					return $this->redirect(['manager', 'parentId' => $parentId]);
				}
			}
		}
		
		return $this->render('create', [
			'modelTopic' => $modelTopic,
			'modelPost' => $modelPost,
			'parentId' => $parentId,
		]);
	}
	
	public function actionView($id, $view_counter = null)
	{
		if (($view_counter != null) and (Topic::updateCounter($id))) {
			return $this->redirect(['view', 'id' => $id]);
		}
		
		$dataProvider = new ActiveDataProvider([
			'query' => Post::find()->with(['author', 'topic'])->where('topic_id = :id', [':id' => $id]),
			'pagination' => [
				'pageSize' => 10,
			],
		]);
				
		return $this->render('view', [
			'dataProvider' => $dataProvider,
			'id' => $id,
			'breadcrumbs' => static::buildBreadcrumbs($id),
			]);
	}
}