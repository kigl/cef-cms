<?php

namespace app\modules\informationsystem\models;

use yii\data\ActiveDataProvider;
use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\models\InformationsystemItem as Item;

class InformationsystemItemSearch extends System
{
	public function rules()
	{
		return [
				[['name'], 'safe'],
		];
	}
	
	public function search($informationsystem_id, $group_id, $params)
	{		
		$query = Item::find()
									->where('parent_id = :parent_id',[':parent_id' => $group_id])
									->andWhere('informationsystem_id = :system_id', [':system_id' =>$informationsystem_id])
									->orderBy('item_type ASC');

		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);
		
		$this->load($params);
		
		if (!$this->validate()) {
			return $dataProvider;
		}
		
		$query->andFilterWhere(['like', 'name', $this->name]);
		$query->orFilterWhere(['like', 'id', $this->name]);	
		
		return $dataProvider;
	}
}
?>