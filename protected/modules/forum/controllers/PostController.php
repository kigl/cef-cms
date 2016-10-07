<?php

namespace app\modules\forum\controllers;

use Yii;
use app\modules\forum\models\Post;

class PostController extends \app\modules\main\components\controllers\FrontendController
{
	
	public function actionUpdate($id)
	{
		$model = Post::findOne($id);
		
		if ($model->load(Yii::$app->request->post()) and $model->save()) {
			return $this->redirect(['topic/view', 'id' => $model->topic_id]);
		}
		
		return $this->render('update', ['model' => $model]);
	}
	
	public function actionCreate($topicId)
	{
		$model = new Post;
		
		if ($model->load(Yii::$app->request->post()) and $model->save()) {
			return $this->redirect(['topic/view', 'id' => $topicId]);
		}
		
		return $this->render('create', [
			'model' => $model,
			'topicId' => $topicId,
		]);
	}
}
