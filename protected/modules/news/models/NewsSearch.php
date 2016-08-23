<?php

namespace app\modules\news\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\base\Model;
use app\modules\news\models\News;


class NewsSearch extends News
{
	public function rules()
	{
		return [
			[['title', 'date', 'id', 'status'], 'safe'],
		];
	}
	
	public function search($params)
	{
		$this->load($params);
		
		$query = News::find()->orderBy('date DESC');
		
		$query->andFilterWhere(['like', 'title', $this->title])
				->andFilterWhere(['like', 'status', $this->status])
				->andFilterWhere(['like', 'date', $this->date ? Yii::$app->formatter->asTimeStamp($this->date) : null ])
				->andFilterWhere(['like', 'id', $this->id]);
	
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => Yii::$app->setting->getValue('main', 'pager_size'),
			],
		]);
				
		return $dataProvider;
	}
}