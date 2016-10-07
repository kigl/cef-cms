<?php

namespace app\modules\forum\controllers\backend;

use yii\data\ActiveDataProvider;
use app\modules\forum\models\Post;

class PostController extends \app\modules\main\components\controllers\BackendController
{	
	public function actionDelete($id)
	{
		if ($model = Post::findOne($id)) {
			$model->delete();
			return $this->redirect(['backend/topic/manager', 'parent_id' => $model->topic_id]);
		} 	 
	}
}