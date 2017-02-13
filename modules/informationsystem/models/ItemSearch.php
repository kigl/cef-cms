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

    public function search(array $params)
    {
        $query = Item::find()
            ->where(['group_id' => !empty($params['id']) ? $params['id'] : null])
            ->andWhere(['informationsystem_id' => $params['informationsystem_id']]);


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