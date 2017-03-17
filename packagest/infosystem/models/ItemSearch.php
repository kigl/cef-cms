<?php

namespace kigl\cef\module\infosystem\models;


use yii\data\ActiveDataProvider;

class ItemSearch extends Item
{
    public function rules()
    {
        return [
            [['name', 'date'], 'safe'],
        ];
    }

    public function search(array $params)
    {
        $query = Item::find()
            ->where(['group_id' => !empty($params['id']) ? $params['id'] : null])
            ->andWhere(['infosystem_id' => $params['infosystem_id']]);


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