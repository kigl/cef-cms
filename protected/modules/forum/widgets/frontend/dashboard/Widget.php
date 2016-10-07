<?php

namespace app\modules\forum\widgets\frontend\dashboard;

use yii\data\ActiveDataProvider;
use app\modules\forum\models\Topic;

class Widget extends \yii\base\Widget
{
	
	public $parentId = 0;
	
	public function run()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Topic::find()->with(['author'])->where("parent_id = {$this->parentId}"),
		]);
		
		return $this->render('index', ['dataProvider' => $dataProvider]);
	}
}