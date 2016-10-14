<?php

namespace app\modules\informationsystem\models;

use Yii;
use yii\data\ActiveDataProvider;

class ItemSearch extends Item
{
    public function rules()
    {
        return [
            [['name', 'date'], 'safe'],
        ];
    }

    public function search($informationsystem_id, $group_id, $params)
    {
        $query = Item::find()
            ->where('group_id = :group_id', [':group_id' => $group_id])
            ->andWhere('informationsystem_id = :system_id', [':system_id' => $informationsystem_id]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}

?>