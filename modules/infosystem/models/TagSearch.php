<?php
namespace app\modules\infosystem\models;


use yii\data\ActiveDataProvider;

class TagSearch extends Tag
{
	public function rules()
	{
		return [
			[['name'], 'safe'],
		];
	}
	
	public function search(array $params)
	{
		$query = Tag::find()
            ->with('infoSystem');
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'defaultOrder' => [
					'id' => SORT_DESC,
				],
			],
		]);
		
		$this->load($params);
		
		if (!$this->validate()) return $dataProvider;

		$query->andFilterWhere(['like', 'name', $this->name]);

		return $dataProvider;
	}
}
?>