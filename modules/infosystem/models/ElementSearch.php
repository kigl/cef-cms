<?php

namespace app\modules\infosystem\models;


use yii\data\ActiveDataProvider;

class ElementSearch extends Element
{
    public function rules()
    {
        return [
            [['name', 'date'], 'safe'],
        ];
    }

    public function search(array $params)
    {
        $query = Element::find()
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