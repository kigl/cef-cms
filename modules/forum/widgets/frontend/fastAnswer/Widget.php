<?php

namespace app\modules\forum\widgets\frontend\fastAnswer;

use Yii;
use app\modules\forum\models\Post;
use app\modules\forum\models\Topic;

class Widget extends \yii\base\Widget
{
	public $topicId;
	
	public function run()
	{
		$model = new Post;
				
		$message = '';
		if ($model->load(Yii::$app->request->post()) and $model->save()) {
			$model = new Post;
			$message = Yii::t('forum', 'Created post');
		}
		
		return $this->render('index', ['model' => $model, 'topicId' => $this->topicId, 'message' => $message]);
	}
}