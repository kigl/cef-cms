<?php
namespace app\modules\informationsystem\models;

use Yii;
use yii\data\ActiveDataProvider;

class TagSearch extends Tag
{
	public function rules()
	{
		return [
			[['name'], 'safe'],
		];
	}
	
	public function search($informationsystem_id, $params)
	{
		$query = Tag::find()->where('informationsystem_id = :id', [':id' => $informationsystem_id]);
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'defaultOrder' => [
					'id' => SORT_DESC,
				],
			],
			'pagination' => [
				'pageSize' => Yii::$app->controller->module->itemsPerPage,
			],
		]);
		
		$this->load($params);
		
		if (!$this->validate()) return $dataProvider;
		
		$query->andFilterWhere(['like', 'name', $this->name]);
		return $dataProvider;
	}
}
?>