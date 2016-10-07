<?php

namespace app\modules\forum\controllers\backend;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\forum\models\Topic;
use app\modules\forum\models\Post;

class TopicController extends \app\modules\main\components\controllers\BackendController
{
	public function actions()
	{
		return [
			'delete' => [
				'class' => 'app\modules\main\components\actions\DeleteAction',
				'model' => Topic::className(),
			],
		];
	}
	
	public function actionManager($parent_id = 0)
	{
		$topicDataProvider = new ActiveDataProvider([
			'query' => Topic::find()->with('author')->where('parent_id = :parent_id', [':parent_id' => $parent_id]),
			'pagination' => [
				'pageSize' => 10,
			],
		]);
		
		$postDataProvider = new ActiveDataProvider([
			'query' => Post::find()->with('author')->where('topic_id = :topic_id', [':topic_id' => $parent_id]),
			'pagination' => [
				'pageSize' => 10,
			],
		]);
		
		return $this->render('manager', [
			'parent_id' => $parent_id,
			'topicDataProvider' => $topicDataProvider,
			'postDataProvider' => $postDataProvider,
		]);
	}
	
	public function actionCreate($parent_id)
	{
		$model = new Topic();
		
		if ($model->load(Yii::$app->request->post()) and $model->save()) {
			return $this->redirect(['manager', 'parent_id' => $parent_id]);
		}
		
		return $this->render('create', [
			'model' => $model,
			'parent_id' => $parent_id,
		]);
	}
}
